<?php
/*
// CSSIMG
// chargement responsive mobile-first des images placées en CSS (background-image),
// et chargement local d'une image très basse résolution en base64
//
// cssimg( $image_id[, $max_size=10000] )
//   $image_id : integer, facultatif, identifiant de l'image
//   $max_size : integer, facultatif,  taille d'image maximale (width)
//   => string, classes css générées automatiquement (ex: 'cssimg cssimg-123')
//
// post_cssimg( [$post_id=NULL][, $max_size=10000] )
//   $post_id : integer, obligatoire, identifiant du post, ou post du contexte si omis ou NULL
//   $max_size : integer, facultatif,  taille d'image maximale (width)
//   => string, classes css générées automatiquement (ex: 'cssimg cssimg-123')
//
// Dans un contexte de Post, pour utiliser l'image à la une : <div class="<?=post_cssimg()?>"></div>
// En appelant l'image à la une d'un Post spécifique : <div class="<?=post_cssimg( 18 )?>"></div>
// En appelant une image spécifique depuis son ID : <div class="<?=cssimg( 18 )?>"></div>
*/

// Ajout des paliers de résolutions
add_action( 'after_setup_theme', function() {
	add_image_size( '16' , 16 );
	add_image_size( '300', 300 );
	add_image_size( '768', 768 );
	add_image_size( '1024', 1024 );
	add_image_size( '1280' , 1280 );
	add_image_size( '1440' , 1440 );
	add_image_size( '1600' , 1600 );
} );

// un peu de pollution globale supplémentaire
$GLOBALS['cssimg'] = array( 'breakpoints' => array() );

// insertion de la balise de style de toute la page.
add_action('wp_footer', function() {
	// génération de la balise de style / mediaqueries en fin de page
	if( count( $GLOBALS['cssimg']['breakpoints'] ) > 0 ) {
		$css = '';
		foreach( $GLOBALS['cssimg']['breakpoints'] as $breakpoint=>$rules ) {
			if( $breakpoint === 0 && count( $rules ) > 0 ) {
				// images par défaut (16px) encodées inline en base64
				$css .= "\n".implode( "\n", $rules );
			} else {
				// mediaqueries
				$css .= "\n".'@media (min-width: '.$breakpoint.'px) { '."\n".implode( "\n", $rules )."\n".' }';
			}
		}
		// écriture des styles
		echo '<style id="cssimg">'."\n".
			'.cssimg { position:relative; background-color:transparent; }'."\n".
			'.cssimg::before { content:""; display:block; position:absolute; z-index:-1; top:0; left:0; width:100%; height:100%; background-repeat:no-repeat; background-position:center center; background-size:cover; }'."\n".
			$css."\n".'</style>';
	}
} );

function post_cssimg( $post_id=NULL, $max=10000 ) {
	// application de cssimg sur l'image à la une du post $post_id
	$post_id = ( $post_id === NULL ? get_the_id() : $post_id );
	if( !$post_id )
		return 'cssimg-error';
	$image_id = get_post_thumbnail_id( $post_id );
	return cssimg( $image_id, $max );
}

function cssimg( $image_id, $max=10000 ) {
	// application de cssimg sur l'image $image_id
	$class = 'cssimg-'.$image_id;
	// url des images du srcset
	$srcset = wp_get_attachment_image_srcset( $image_id, 'full' );
	$srcset = explode( ', ', $srcset );

	// préparation du tableau des différentes tailles d'images
	$sizes = array();
	foreach( $srcset as $set ) {
		$tmp = explode( ' ', $set );
		if( !isset( $tmp[0], $tmp[1] ) ) continue;
		$size = (int) trim($tmp[1],'w');
		if( $size <= $max ) {
			$sizes[] = array(
				'max'=> $size + 1,
				'url'=> $tmp[0],
			);
		}
	}
	usort( $sizes, function( $a, $b ) { return $a['max'] - $b['max']; } );

	// préparation du tableau des mediaqueries
	for( $i=0, $j=count( $sizes ); $i < $j; $i++ ) {
		$sizes[$i] = array(
			'max'=> ( $i===$j-1 ? 0 : $sizes[$i]['max'] ),
			'min'=> ( isset( $sizes[$i-1] ) ? $sizes[$i-1]['max'] : 0 ),
			'url'=> $sizes[$i]['url'],
		);
	}

	// enregistrement des mediaqueries dans un tableau global pour traitement futur
	foreach( $sizes as $size ) {
		if( !isset( $GLOBALS['cssimg']['breakpoints'][$size['min']] ) )
			$GLOBALS['cssimg']['breakpoints'][$size['min']] = array();
		if( $size['min'] === 0 ) {
			$GLOBALS['cssimg']['breakpoints'][$size['min']][] = '.'.$class.'::before { background-image: url(data:image/jpeg;base64,'.base64_encode( file_get_contents( $size['url'] ) ).'); }';
		} else {
			$GLOBALS['cssimg']['breakpoints'][$size['min']][] = "\t".'.'.$class.' { background-image: url('.esc_url( $size['url'] ).'); }';
		}
	}

	// renvoi les classes à appliquer à l'objet DOM
	return 'cssimg '.$class;
}
