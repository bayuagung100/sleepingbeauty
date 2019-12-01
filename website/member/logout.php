<?php
  session_destroy();
  echo "<script>
		alert('Anda telah logout'); 
		window.location = '".$set['url']."';
		</script>";
?>