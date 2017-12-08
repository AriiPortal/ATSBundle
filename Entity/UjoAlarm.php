<?php

namespace Arii\ATSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UjoAlarm
 *
 * @ORM\Table(name="UJO_ALARM")
 * @ORM\Entity(readOnly=true)
 */
class UjoAlarm
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ALARM", type="integer", nullable=true)
     */
    private $alarm;

    /**
     * @var integer
     *
     * @ORM\Column(name="ALARM_TIME", type="integer", nullable=true)
     */
    private $alarmTime;

    /**
     * @var string
     *
     * @ORM\Column(name="EOID", type="string", length=12, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="UJO_ALARM_EOID_seq", allocationSize=1, initialValue=1)
     */
    private $eoid;

    /**
     * @var string
     *
     * @ORM\Column(name="EVENT_COMMENT", type="string", length=255, nullable=true)
     */
    private $eventComment;

    /**
     * @var integer
     *
     * @ORM\Column(name="EVT_NUM", type="integer", nullable=true)
     */
    private $evtNum;

    /**
     * @var integer
     *
     * @ORM\Column(name="JOID", type="integer", nullable=true)
     */
    private $joid;

    /**
     * @var integer
     *
     * @ORM\Column(name="LEN", type="integer", nullable=true)
     */
    private $len;

    /**
     * @var string
     *
     * @ORM\Column(name="RESPONSE", type="string", length=255, nullable=true)
     */
    private $response;

    /**
     * @var integer
     *
     * @ORM\Column(name="STATE", type="integer", nullable=true)
     */
    private $state;

    /**
     * @var integer
     *
     * @ORM\Column(name="STATE_TIME", type="integer", nullable=true)
     */
    private $stateTime;

    /**
     * @var string
     *
     * @ORM\Column(name="THE_USER", type="string", length=60, nullable=true)
     */
    private $theUser;



    /**
     * Set alarm
     *
     * @param integer $alarm
     * @return UjoAlarm
     */
    public function setAlarm($alarm)
    {
        $this->alarm = $alarm;

        return $this;
    }

    /**
     * Get alarm
     *
     * @return integer 
     */
    public function getAlarm()
    {
        return $this->alarm;
    }

    /**
     * Set alarmTime
     *
     * @param integer $alarmTime
     * @return UjoAlarm
     */
    public function setAlarmTime($alarmTime)
    {
        $this->alarmTime = $alarmTime;

        return $this;
    }

    /**
     * Get alarmTime
     *
     * @return integer 
     */
    public function getAlarmTime()
    {
        return $this->alarmTime;
    }

    /**
     * Get eoid
     *
     * @return string 
     */
    public function getEoid()
    {
        return $this->eoid;
    }

    /**
     * Set eventComment
     *
     * @param string $eventComment
     * @return UjoAlarm
     */
    public function setEventComment($eventComment)
    {
        $this->eventComment = $eventComment;

        return $this;
    }

    /**
     * Get eventComment
     *
     * @return string 
     */
    public function getEventComment()
    {
        return $this->eventComment;
    }

    /**
     * Set evtNum
     *
     * @param integer $evtNum
     * @return UjoAlarm
     */
    public function setEvtNum($evtNum)
    {
        $this->evtNum = $evtNum;

        return $this;
    }

    /**
     * Get evtNum
     *
     * @return integer 
     */
    public function getEvtNum()
    {
        return $this->evtNum;
    }

    /**
     * Set joid
     *
     * @param integer $joid
     * @return UjoAlarm
     */
    public function setJoid($joid)
    {
        $this->joid = $joid;

        return $this;
    }

    /**
     * Get joid
     *
     * @return integer 
     */
    public function getJoid()
    {
        return $this->joid;
    }

    /**
     * Set len
     *
     * @param integer $len
     * @return UjoAlarm
     */
    public function setLen($len)
    {
        $this->len = $len;

        return $this;
    }

    /**
     * Get len
     *
     * @return integer 
     */
    public function getLen()
    {
        return $this->len;
    }

    /**
     * Set response
     *
     * @param string $response
     * @return UjoAlarm
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return string 
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return UjoAlarm
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set stateTime
     *
     * @param integer $stateTime
     * @return UjoAlarm
     */
    public function setStateTime($stateTime)
    {
        $this->stateTime = $stateTime;

        return $this;
    }

    /**
     * Get stateTime
     *
     * @return integer 
     */
    public function getStateTime()
    {
        return $this->stateTime;
    }

    /**
     * Set theUser
     *
     * @param string $theUser
     * @return UjoAlarm
     */
    public function setTheUser($theUser)
    {
        $this->theUser = $theUser;

        return $this;
    }

    /**
     * Get theUser
     *
     * @return string 
     */
    public function getTheUser()
    {
        return $this->theUser;
    }
}
