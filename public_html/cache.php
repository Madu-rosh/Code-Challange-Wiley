<?php 

class Cache
{
    const redisServer = '172.23.0.2'; //this may change if you rebuilt docker
    const redisServerPort = 6379;
    const redisPassword = 'root';
    private $redis;

    public function __construct(){
        $this->redis = new Redis();
        $this->redis->connect(self::redisServer, self::redisServerPort);
        $this->redis->auth(self::redisPassword);
    }

    private function fromCache(){
        $cached = true;
        $clientCached = isset($_SERVER['HTTP_CACHE_CONTROL']) ? $_SERVER['HTTP_CACHE_CONTROL'] : '';
        if(!empty($clientCached)){
            if($clientCached == 'no-cache' || $clientCached == 'must-revalidate' || $clientCached == 'max_age=0'){
                $cached = false;
            }
        }
        return $cached;
    }

    /* if the file got cache values set it'll be cached */
    public function get($url, $opts){
        if($this->redis->exists($url)){
            if($this->fromCache()){
                $data = $this->redis->get($url);
            }else{
                $data = file_get_contents($url, false, stream_context_create($opts));
            }
        }else{
            $data = file_get_contents($url, false, stream_context_create($opts));
            $this->redis->set($url, $data);
        }
        return $data;
    }
}