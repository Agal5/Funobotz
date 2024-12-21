<?php
  $content .= '<div class="gbb-row-wrapper">';
  if(isset($row_attr['icon']) && $row_attr['icon']){ 
    $content .= '<span class="icon-row '. $row_attr['icon'] . '"></span>';
  }
  $data_bg_video = $data_bg_video ? $data_bg_video : '';
  $row_id_html = (isset($row_attr['row_id']) && $row_attr['row_id']) ? 'id="'.$row_attr['row_id'].'"' : '';
  $style_space = (isset($row_attr['style_space']) && $row_attr['style_space']) ? $row_attr['style_space'] : '';

  $content .= '<div class="'.$row_class .'" '. $row_id_html .' style="'. $row_style .'" '. $data_bg_video . '>';
    $content .= '<div class="bb-inner '.$style_space.'">';  
      $content .= '<div class="bb-container '. $row_attr['layout'] .'">';
        $content .= '<div class="row">';
          $content .= '<div class="row-wrapper clearfix">';
            
            if(isset($row['columns']) && is_array($row['columns'])){
              foreach( $row['columns'] as $column ){
                if(isset($column['attr']) && $column['attr']){
                  $col_attr = $column['attr'];
                }else{
                  $col_attr = null;
                }  
                $class  = ''; $class_inner = '';
                if($col_attr && isset($classes[$col_attr['size']]) && $classes[$col_attr['size']]){
                  $class = $classes[$col_attr['size']];
                }   
                if(isset($col_attr['class']) && $col_attr['class']){
                  $class .= ' ' . $col_attr['class'];
                }

                if(isset($col_attr['class_inner']) && $col_attr['class_inner']){
                  $class_inner = $col_attr['class_inner'];
                }
                
                //Responsive
                if(isset($col_attr['hidden_lg']) && $col_attr['hidden_lg'] == 'hidden'){
                  $class .= ' hidden-lg'; 
                }
                if(isset($col_attr['hidden_md']) && $col_attr['hidden_md'] == 'hidden'){
                  $class .= ' hidden-md'; 
                }
                if(isset($col_attr['hidden_sm']) && $col_attr['hidden_sm'] == 'hidden'){
                  $class .= ' hidden-sm'; 
                }
                if(isset($col_attr['hidden_xs']) && $col_attr['hidden_xs'] == 'hidden'){
                  $class .= ' hidden-xs'; 
                }

              $column_id = '';
              if(isset($col_attr['column_id']) && $col_attr['column_id']){
                $column_id = $col_attr['column_id'];
              }

              $col_style_array = array();
    
              // Background for row
              if(isset($col_attr['bg_color']) && $col_attr['bg_color']){
                $col_style_array[]  = 'background-color:'. $col_attr['bg_color'];
              }
              $class_col_parallax = '';
              if( isset($col_attr['bg_image']) && $col_attr['bg_image'] ){
                $col_style_array[]  = 'background-image:url('. $base_url . '/' . $col_attr['bg_image'] .')';
                $col_style_array[]  = 'background-repeat:' . $col_attr['bg_repeat'];
                $col_style_array[]    = 'background-attachment:' . $col_attr['bg_attachment']; 
                if(isset($col_attr['bg_attachment']) && $col_attr['bg_attachment']=='fixed'){
                  $col_style_array[]  = 'background-position: 50% 0';
                  $class_col_parallax = 'gva-parallax-background';
                }else{
                  $col_style_array[]  = 'background-position:' . $col_attr['bg_position'];
                }
              }
              $col_style  = implode('; ', $col_style_array );
              
              $col_bg_size = 'bg-size-cover';
              if(isset($col_attr['bg_size']) && $col_attr['bg_size']){
                $col_bg_size = 'bg-size-' . $col_attr['bg_size'];
              }
              $column_id_html = $column_id ? 'id="'.$column_id.'"' : '';
              $content .= '<div ' . $column_id_html .' class="gsc-column '. $class .'">';
                $content .= '<div class="column-inner ' . $class_col_parallax . ' ' . $col_bg_size . ' ' . $class_inner .'" ' . $col_style . '>';
                  $content .= '<div class="column-content-inner">';
                     if( is_array( $column['items'] ) ){       
                        foreach( $column['items'] as $item ){
                           $shortcode = '\\Drupal\gavias_blockbuilder\shortcodes\\'.$item['type'];
                           if( class_exists($shortcode) ){
                              $sc = new $shortcode;
                              if(method_exists($sc, 'render_content')){
                                ob_start();
                                  $sc->render_content($item);
                                 $content .= ob_get_clean();
                              } 
                           }
                        }
                     }
                  $content .= '</div>';

                  if(isset($col_attr['bg_attachment']) && $col_attr['bg_attachment']=='fixed'){ 
                    $content .= '<div style="background-repeat:' . $col_attr['bg_repeat'] . ';background-position:' . $col_attr['bg_position'] .';" class="' . $col_bg_size .' gva-parallax-inner skrollable skrollable-between" data-bottom-top="top: -68%;" data-top-bottom="top: 0%;"></div>';
                  } 

                $content .= '</div>';
              $content .= '</div>';
              }
            }
        $content .= '</div>';
      $content .= '</div>';
    $content .= '</div>';
  $content .= '</div>';

  if(isset($row_attr['bg_attachment']) && $row_attr['bg_attachment']=='fixed'){ 
    $content .= '<div style="background-repeat:'.$row_attr['bg_repeat'].';background-position:'.$row_attr['bg_position'].';" class="gva-parallax-inner skrollable skrollable-between'. $row_bg_size .'" data-bottom-top="top: -68%;" data-top-bottom="top: 0%;"></div>';
   } 

$content .= '</div>';
$content .= '</div>';