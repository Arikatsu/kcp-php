<?php

namespace labalityowo\kcp;

use labalityowo\Bytebuffer\Buffer;

class Segment
{
    private int $conv = 0;
    private int $token = 0;
    private int $cmd = 0;
    private int $frg = 0;
    private int $wnd = 0;
    private int $ts = 0;
    private int $sn = 0;
    private int $una = 0;
    private int $resendTs = 0;
    private int $rto = 0;
    private int $fastAck = 0;
    private int $xmit = 0;

    public function __construct(public Buffer $data){}

    public function size()
    {
        return KCP::KCP_OVERHEAD + $this->data->getLength();
    }

    public function encode(Buffer &$buffer, int $offset = 0): int
    {
        if ($buffer->getLength() < $this->size()) {
            throw new \Exception("Buffer is too small");
        }

        $buffer->writeUInt32LE($this->getConv(), $offset);
        $buffer->writeUInt32LE($this->getToken(), $offset + 4);
        $buffer->writeUInt8($this->getCmd(), $offset + 8);
        $buffer->writeUInt8($this->getFrg(),  $offset + 9);
        $buffer->writeUInt16LE($this->getWnd(), $offset + 10);
        $buffer->writeUInt32LE($this->getTs(), $offset + 12);
        $buffer->writeUInt32LE($this->getSn(), $offset + 16);
        $buffer->writeUInt32LE($this->getUna(), $offset + 20);
        $buffer->writeUInt32LE($this->getData()->getLength(), $offset + 24);
        $this->getData()->copy($buffer, $offset + 28);
        return $this->size();
    }

    /**
     * @return int
     */
    public function getConv(): int
    {
        return $this->conv;
    }

    /**
     * @param int $conv
     */
    public function setConv(int $conv): void
    {
        $this->conv = $conv;
    }

    /**
     * @return int
     */
    public function getToken(): int
    {
        return $this->token;
    }

    /**
     * @param int $token
     */
    public function setToken(int $token): void
    {
        $this->token = $token;
    }

    /**
     * @return int
     */
    public function getCmd(): int
    {
        return $this->cmd;
    }

    /**
     * @param int $cmd
     */
    public function setCmd(int $cmd): void
    {
        $this->cmd = $cmd;
    }

    /**
     * @return int
     */
    public function getFrg(): int
    {
        return $this->frg;
    }

    /**
     * @param int $frg
     */
    public function setFrg(int $frg): void
    {
        $this->frg = $frg;
    }

    /**
     * @return int
     */
    public function getWnd(): int
    {
        return $this->wnd;
    }

    /**
     * @param int $wnd
     */
    public function setWnd(int $wnd): void
    {
        $this->wnd = $wnd;
    }

    /**
     * @return int
     */
    public function getTs(): int
    {
        return $this->ts;
    }

    /**
     * @param int $ts
     */
    public function setTs(int $ts): void
    {
        $this->ts = $ts;
    }

    /**
     * @return int
     */
    public function getSn(): int
    {
        return $this->sn;
    }

    /**
     * @param int $sn
     */
    public function setSn(int $sn): void
    {
        $this->sn = $sn;
    }

    /**
     * @return int
     */
    public function getUna(): int
    {
        return $this->una;
    }

    /**
     * @param int $una
     */
    public function setUna(int $una): void
    {
        $this->una = $una;
    }

    /**
     * @return int
     */
    public function getResendTs(): int
    {
        return $this->resendTs;
    }

    /**
     * @param int $resendTs
     */
    public function setResendTs(int $resendTs): void
    {
        $this->resendTs = $resendTs;
    }

    /**
     * @return int
     */
    public function getRto(): int
    {
        return $this->rto;
    }

    /**
     * @param int $rto
     */
    public function setRto(int $rto): void
    {
        $this->rto = $rto;
    }

    /**
     * @return int
     */
    public function getFastAck(): int
    {
        return $this->fastAck;
    }

    /**
     * @param int $fastAck
     */
    public function setFastAck(int $fastAck): void
    {
        $this->fastAck = $fastAck;
    }

    /**
     * @return int
     */
    public function getXmit(): int
    {
        return $this->xmit;
    }

    /**
     * @param int $xmit
     */
    public function setXmit(int $xmit): void
    {
        $this->xmit = $xmit;
    }

    /**
     * @return Buffer
     */
    public function getData(): Buffer
    {
        return $this->data;
    }

    /**
     * @param Buffer $data
     */
    public function setData(Buffer $data): void
    {
        $this->data = $data;
    }
}