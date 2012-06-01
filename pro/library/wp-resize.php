<?php 

/* WP-Resize: a TimThumb alternative using native WP functions. Original credit goes to Victor Teixeira (http://wpquestions.com/user/discourseShow/id/1981/discourse_id/20)

/* Example use:

  <?php 

  $thumb = get_post_thumbnail_id(); 

  $image = wp_resize( $thumb,'' , 140, 110, true );

  ?>




 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />

 *

 * @param int $attach_id

 * @param string $img_url

 * @param int $width

 * @param int $height

 * @param bool $crop

 * @return array

 */

function wp_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {



	// this is an attachment, so we have the ID

	if ( $attach_id ) {

	

		$image_src = wp_get_attachment_image_src( $attach_id, 'full' );

		$file_path = get_attached_file( $attach_id );

	

	// this is not an attachment, let's use the image url

	} else if ( $img_url ) {

		

		$file_path = parse_url( $img_url );

		$file_path = ltrim( $file_path, home_url() );

		//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];

		

		$orig_size = getimagesize( $file_path );

		

		$image_src[0] = $img_url;

		$image_src[1] = $orig_size[0];

		$image_src[2] = $orig_size[1];

	}

	else {
	
		$file_path = '';
		$image_src[0] = '';
		$image_src[1] = '';
		$image_src[2] = '';
		
	}

	$file_info = pathinfo( $file_path );

	$extension = '.'. (!isset($file_info['extension']));



	// the image path without the extension

	$no_ext_path = (!isset($file_info['dirname'])).'/'.$file_info['filename'];



	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;



	// checking if the file size is larger than the target size

	// if it is smaller or the same size, stop right here and return

	if ( $image_src[1] > $width || $image_src[2] > $height ) {



		// the file is larger, check if the resized version already exists (for crop = true but will also work for crop = false if the sizes match)

		if ( file_exists( $cropped_img_path ) ) {



			$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );

			

			$wp_image = array (

				'url' => $cropped_img_url,

				'width' => $width,

				'height' => $height

			);

			

			return $wp_image;

		}



		// crop = false

		if ( $crop == false ) {

		

			// calculate the size proportionaly

			$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );

			$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			



			// checking if the file already exists

			if ( file_exists( $resized_img_path ) ) {

			

				$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );



				$wp_image = array (

					'url' => $resized_img_url,

					'width' => $new_img_size[0],

					'height' => $new_img_size[1]

				);

				

				return $wp_image;

			}

		}



		// no cached files - let's finally resize it

		$new_img_path = image_resize( $file_path, $width, $height, $crop );

		$new_img_size = getimagesize( $new_img_path );

		$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );



		// resized output

		$wp_image = array (

			'url' => $new_img,

			'width' => $new_img_size[0],

			'height' => $new_img_size[1]

		);

		

		return $wp_image;

	}



	// default output - without resizing

	$wp_image = array (

		'url' => $image_src[0],

		'width' => $image_src[1],

		'height' => $image_src[2]

	);

	

	return $wp_image;

}
?>