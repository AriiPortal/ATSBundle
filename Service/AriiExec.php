<?php
namespace Arii\ATSBundle\Service;

class AriiExec {
    
    protected $host; 
    protected $user; 
    protected $password; 
    protected $profile;
    
    public function __construct( $ats ) {
        $this->host = $ats['host'];
        $this->user = $ats['user'];
        $this->password = $ats['password'];
        $this->profile = $ats['profile'];
    }
    
    public function Exec($command) {
        set_include_path(get_include_path() . PATH_SEPARATOR . '../vendor/phpseclib');
        include('Net/SSH2.php');

        $ssh = new \Net_SSH2($this->host);
        if (!$ssh->login($this->user, $this->password)) {
            exit('Login Failed');
        }

        return $ssh->exec(". ".$this->profile.";$command");
    }
}
?>
