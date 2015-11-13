<?php
namespace Arii\ATSBundle\Service;

class AriiExec {
    
    protected $session;
    protected $audit;
    protected $log;
    
    public function __construct(
            \Arii\CoreBundle\Service\AriiSession $session, 
            \Arii\CoreBundle\Service\AriiAudit $audit,  
            \Arii\CoreBundle\Service\AriiLog $log
    ) {
        $this->session = $session;
        $this->audit = $audit;
        $this->log = $log;
    }
    
    public function Exec($command,$stdin='') {
        $database = $this->session->getDatabase();
        $name = $database['name'];
        
        $engine = $this->session->getSpoolerByName($name,'waae');
        
        if (!isset($engine[0]['shell'])) {
            print "?!";
            exit();
        }
        
        $shell = $engine[0]['shell'];
        $host = $shell['host'];
        $user = $shell['user'];
        $password = $shell['password'];
        
        $method = 'CURL';

        set_include_path(get_include_path() . PATH_SEPARATOR . '../vendor/phpseclib');
        include('Net/SSH2.php');
        
        $ssh = new \Net_SSH2($host);
        if (!$ssh->login($user, $password)) {
            exit('Login Failed');
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
