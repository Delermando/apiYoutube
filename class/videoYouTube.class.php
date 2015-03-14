<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class videoYouTube{
    public function getVideos($user,$idPlaylist){
        $usuario = $user;
        $youTube_UserFeedURL = 'http://gdata.youtube.com/feeds/api/playlists/'.$idPlaylist.'?v=2';
        
 
        // URL do Feed RSS de vídeos de um usuário
        //$youTube_UserFeedURL = 'http://gdata.youtube.com/feeds/api/playlists/PL73A4F620D05BA51F?v=2';

        // Usa cURL para pegar o XML do feed
        $cURL = curl_init(sprintf($youTube_UserFeedURL, $usuario));
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURL, CURLOPT_FOLLOWLOCATION, true);
        $resultado = curl_exec($cURL);
        curl_close($cURL);

        // Inicia o parseamento do XML com o SimpleXML
        $xml = new SimpleXMLElement($resultado);

        $videos = array();

        // Passa por todos vídeos no RSS
        foreach ($xml->entry AS $video) {
                $url = (string)$video->link['href'];

                // Quebra a URL do vídeo para pegar o ID
                parse_str(parse_url($url, PHP_URL_QUERY), $params);
                $id = $params['v'];

                // Monta um array com os dados do vídeo
                $videos[] = array(
                        'id' => $id,
                        'titulo' => (string)$video->title,
                        'thumbnail' => 'http://i' . rand(1, 4) .'.ytimg.com/vi/'. $id .'/hqdefault.jpg',
                        'url' => $url
                );
        }
        return $videos;
    
    }
}
