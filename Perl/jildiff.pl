#!/usr/bin/perl
%Info = (
        'name'                  => 'JilDiff',
        'desc'                  => 'This script gives the differences beetween 2 Jils, this allows to know the changes before insertion. ',
        'usage'                 => 'jildiff.pl jil=Referential.jil [jil=(y|n)] < jil_to_insert.JIL > diff.jil',
        'author'                => 'E. Angenault',
        'license'               => 'GNU GPL',
        'website'               => 'http://ordonnancement.org',
        'input'                 => 'jil file',
        'parameters'=>
                (       'jil'=> 'Jil file name used as the referential',
                        'del'=> 'y:     if jobs exist in referential but not in the new jil, these jobs will be marked as delete_job.' ),
        'return'                => 'jil file' );
#-----------------------------------------------------------------#
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.

# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
# GNU General Public License for more details.
#-----------------------------------------------------------------#

# Display help screen if no args specified
Help(%Info);
# get command line parameters
GetArgs();

$del='n'
        unless $del;
$verbose='n'
        unless $verbose;
$Val{' job_type'}++;

# Nouveaux types en 11.3
%NewJobtype = (c,CMD,b,BOX,f,FW);

# Source est nouveau JIL
# Target est la cible qui contient deja des informations
open(FILE,$jil);
while (<FILE>) {
        if (s/^\s*(insert|update|delete)_job: (\S*)//) {
                $job = $2;
                $Target{$job."\t insert_job"} = $job;
                $T{$job}++;
        }
        if (/^\s*([\w\_]*?): (.*)\s*$/) {
                $var = $1; $val = $2;                
                # Passage en 11.3
                $val = $NewJobtype{$val}
                        if (($var eq 'job_type') && ($val =~ /[cbf]/));
                $val =~ s/\s+$//;
                $Target{$job."\t".$var} = $val;
                $Val{$1}++;
        }
}

while (<STDIN>) {
        if (s/^\s*(insert|update|delete)_job: (\S*)//) {
                $job = $2;
                $Source{$job."\t insert_job"} = $job;
                $S{$job}++;
        }
        if (/^\s*([\w\_]*?): (.*)\s*$/) {
                $var = $1; $val = $2;
                # Passage en 11.3
                $val = $NewJobtype{$val}
                        if (($var eq 'job_type') && ($val =~ /[cbf]/));
                $val =~ s/\s+$//;
                $Source{$job."\t".$var} = $val;
                $Val{$1}++;
        }
}

# On prend la source
$nb_delete=0;
$nb_insert=0;
$nb_update=0;
foreach $j (sort keys %T) {
        # Job dans l'instance mais pas dans le gabarit => DELETE
        $k = $j."\t insert_job";
        # print "\n\n/* $j */\n";
        if ($Source{$k} eq '') {
                if ($del ne 'n') {
                        print "\ndelete_job: $j\n";
                        $nb_delete++;
                }
        }
        # Sinon UPDATE
        else {
                $update = '';
                foreach $v (sort keys %Val) {
                        $k = $j."\t".$v;
                        if (($Target{$k}) ne ($Source{$k})) {
                                if ($Target{$k} ne '') {
                                        $update .= "#\t$v: $Target{$k}\n";
                                }
                                $update .= "\t$v: $Source{$k}\n";
                        }
                }
                if ($update ne '') {
                        $nb_update++;
                        print "\nupdate_job: $j\n$update";
                }
        }
}

# Ce qui est dans la source mais pas dans la cible
foreach $j (sort keys %S) {
        $k = $j."\t insert_job";
        if ($Target{$k} eq '') {
                # print "\n\n/* $j */\n";
                print "\ninsert_job: $j\n";
                $nb_insert++;
                foreach $v (sort keys %Val) {
                        $k = $j."\t".$v;
                        if ($Source{$k} ne '') {
                                print "\t$v: $Source{$k}\n";
                        }
                }
        }
}

print STDERR "insert: $nb_insert\n";
print STDERR "update: $nb_update\n";
print STDERR "delete: $nb_delete\n";

sub GetArgs {
local(%Default) = @_;

        # Parametres en arguments
        foreach (@ARGV) {
                ($var,@Val) = split('=');
                $val = join('=',@Val);
                if ($val eq 'STDIN') {
                        while (<STDIN>) {
                                chop;
                                if (@Head) {
                                        @Infos{@Head} = split(/\t/);
                                        foreach $k (keys %Infos) {
                                                push(@{$k},$Infos{$k});
                                        }
                                }
                                else {
                                        @Head = split(/\t/);
                                }
                        }
                }
                else {
                        ${$var} = $val
                                if ($var !~ s/^\!//);
                }
        }
        # parametres en ligne de commande

        # parametres par defaut
        foreach $d (keys %Default) {
                ${$d} = $Default{$d}
                        unless ${$d};
        }
}

sub Help {
%Info=@_;
        if ($HELP) {
                print $Info{'name'}."\n\n";
                print $Info{'desc'}."\n";
                exit;
        }
}
