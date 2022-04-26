<?php

function env(string $name,string $value = null){
        $env_path = __DIR__ . '/.env';
        if (file_exists($env_path)){
            $env_file_map = file_get_contents($env_path);
            $env_file = explode(PHP_EOL,$env_file_map);
            foreach ($env_file as $key => $values){
                if (preg_match('/([0-9-a-z-A-Z-\_]+)\=(.*)/',$values,$match_env)){
                    if ($match_env[1] == $name){
                        if (is_null($value)){
                            return (trim($match_env[2]));
                        }
                        if (file_put_contents($env_path,str_replace($values,$name."=" . $value,$env_file_map))){
                            return (trim($value));
                        } else{
                            return false;
                        }
                    }
                }
            }
            return false;
        }else{
            file_put_contents($env_path,null);
        }
    }
