<?php
namespace Arii\ATSBundle\Service;

class AriiExec {
    
    protected $session;
    
    public function __construct(
            \Arii\CoreBundle\Service\AriiSession $session
    ) {
        $this->portal = $portal;
    }
    
    public function Exec($command,$stdin='') {
        $database = $this->session->getDatabase();
        $name = $database['name'];
        
        $engine = $this->session->getSpoolerByName($name,'waae');
        
        if (!isset($engine[0]['shell'])) {
            $portal->ErrorLog("Unknown DB", 1,  __FILE__, __LINE__);
            exit();
        }

        set_include_path('../vendor/phpseclib' . PATH_SEPARATOR . get_include_path());
        include('Net/SSH2.php');
        include('Crypt/RSA.php');

        $shell = $engine[0]['shell'];
        $host = $shell['host'];
        $user = $shell['user'];
        $ssh = new \Net_SSH2($host);
        
        if (isset($shell['key'])) {
            $key = new \Crypt_RSA();
            $ret = $key->loadKey($shell['key']);
            if (!$ret) {
                echo "loadKey failed\n";
                print "<pre>".$ssh->getLog().'</pre>';
                exit;
            }
        }
        elseif (isset($shell['password'])) {
            $key = $shell['password'];
        }
        else {
            $key = ''; // ?! possible ?
        }
               
        if (!$ssh->login('autosys', $key)) {
            print 'Login Failed';
            print "<pre>".$ssh->getLog().'</pre>';
            exit();
        }

        if ($stdin=='')
            return $ssh->exec(". ~/.bash_profile;$command");

        // Test STDIN
        $ssh->enablePTY();
        print "profile".$ssh->exec(". ~/.bash_profile");
        print "sort".$exec = $ssh->exec('sort');
        $ssh->write(<<<EOF
echo "update_job: SE.ERIC.JOB.JobType_UNIX"
echo "description: 'ok!!'
EOF
);
        $ssh->reset(true);
$ssh->setTimeout(2);
print $ssh->read();
return ;
return  $ssh->read();  // outputs the echo above
    }
}
?>
