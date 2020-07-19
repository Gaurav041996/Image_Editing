<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/style.css')}}"></link>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap.min.css')}}">

    </head>
    <body>
      
    <div id="container">
		<div id="row" class="main">
			<label style="font-size: 22px;margin-left: 300px;font-weight: bold;">Upload Image</label>
            <form id="file_form" class="form_class" action="{{url('/upload')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
				<label>Select File: </label>
				<input type="file" name="image" id="file" onchange="readURL(this);"><br>
				<label>Text :</label><input type="text" name="img_text" id="img_text"><br>
				<input type="hidden" name="img_path" id="img_path" value="{{ asset('upload/') }}">
				<input class="btn btn-primary btn_class" type="button" name="add_btn" id="add_btn" value="Add Text">
				<input class="btn btn-primary" type="button" name="resize_btn" id="resize_btn" value="Resize Image">
				<input class="btn btn-primary" type="button" name="flip_btn" id="flip_btn" value="Flip Image">
                <input class="btn btn-primary" type="button" name="frame_btn" id="frame_btn" onclick="frame();" value="Add Frame and Text">
                <input type="hidden" value="" id="flip_opt" name="flip_opt">
                <input type="hidden" value="" id="resize_opt" name="resize_opt">
                <input type="hidden" value="" id="frame_opt" name="frame_opt">
			<div id="sec_image" class="image_sec">
				<img src="{{asset('images/frame.png')}}" id="frame_bg" style="display:none; position: relative;top: 0;left: 0;" width=500px height="500px">
				<img id="img_dis" src="" >	
                <div class="centered"></div>
				
            </div>
            <br>
				<input class="btn btn-primary" type="submit" name="frame_btn" value="Download">
			</form> 
		</div>
	</div>
    </body>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">

function readURL(input) {
            //  console.log(input);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_dis')
                        .attr('src', e.target.result)
                        .width(500);
                        
                };

                reader.readAsDataURL(input.files[0]);
            }
        }    
        function frame() {
                $("#frame_bg").css("display","block");
                $('#img_dis').addClass('importantRule');
                    $('#img_dis').css({"position":"absolute","top":"117px","left":"109px"});
                    var txt=$('#img_text').val();
                    $(".centered").text(txt);
                    }
        
	$(document).ready(function(){
         
 		$("#add_btn").click(function(){
 			var txt=$('#img_text').val();
            
            $(".centered").text(txt);
 			
 		});
 		$("#flip_btn").click(function(){
 			$("#sec_image").addClass("flip"); 
             $("#flip_opt").val("flip");
 		});
         $("#resize_btn").click(function(){
 			$("#img_dis").width(500).height(500); 
             $("#resize_opt").val("resize");
 		});
         $("#frame_btn").click(function(){
 			$("#img_dis").width(500).height(500); 
             $("#frame_opt").val("frame");
 		})
 	});
	
</script>

</html>
