<?php
function buka_form($link, $id, $aksi)
{
	echo '<form method="post" action="' . $link . '&show=action" class="form-horizontal" enctype="multipart/form-data" style="padding:10px">
			<input type="hidden" name="id" value="' . $id . '">
			<input type="hidden" name="aksi" value="' . $aksi . '">';
}

function buat_textbox($label, $nama, $nilai, $place, $tipe = "text")
{
	echo '<div class="form-group">
		<label for="' . $nama . '">' . $label . '</label>
		<input type="' . $tipe . '" id="' . $nama . '" class="form-control" name="' . $nama . '" value="' . $nilai . '" placeholder="' . $place . '">
		</div>';
}
function buat_time($label, $nama, $nilai, $place, $tipe = "text")
{
	echo '<div class="form-group">
		<label for="' . $nama . '">' . $label . '</label>
		<div class="input-group date" id="' . $nama . '" data-target-input="nearest">
		<input type="' . $tipe . '" id="' . $nama . '" class="form-control datetimepicker-input" data-target="#' . $nama . '" data-toggle="datetimepicker" name="' . $nama . '" value="' . $nilai . '" placeholder="' . $place . '">
		</div>
		<script>
		$(function () {
			$("#' . $nama . '").datetimepicker({
				format: "LT"
			})
		})
		</script>
		</div>';
}
function buat_tinymce($label, $nama, $nilai, $place, $class = '')
{
	echo '<div class="form-group">
			<label>' . $label . '</label>
			<textarea name="' . $nama . '" class="form-control ' . $class . '" placeholder="' . $place . '">' . $nilai . '</textarea>
		 </div>
		 ';
}
function buat_textarea($label, $nama, $nilai, $place)
{
	echo '<div class="form-group">
			<label>' . $label . '</label>
			<textarea name="' . $nama . '" class="form-control" placeholder="' . $place . '">' . $nilai . '</textarea>
		 </div>
		 ';
}

function buat_inlinebuka()
{
	echo '<div class="form-group row">';
}
function buat_inlinebuka_col($col = "3")
{
	echo '<div class="col-md-' . $col . '">';
}
function buat_inline($label, $nama, $nilai, $place, $tipe = "text")
{
	echo '
            <label for="' . $nama . '" >' . $label . '</label>
            <input type="' . $tipe . '" id="' . $nama . '" class="form-control" name="' . $nama . '" value="' . $nilai . '" placeholder="' . $place . '">
        
    ';
}
function buat_inline_multi_select_size($label, $nama, $list, $nilai, $place)
{ 	
	echo '	
            <label for="' . $nama . '" >' . $label . '</label>
			<select name="' . $nama . '" class="select2" multiple="multiple" data-placeholder="' . $place . '" style="width: 100%;">';

			if (strpos($nilai, ',') == true) {
				$ex = explode(",", $nilai);
				foreach ($ex as $key) {
					global $mysqli;
					$query = $mysqli->query("SELECT * FROM size_product WHERE id='$key' ");
					$data = $query->fetch_array();
					echo '<option value=' . $key . ' selected>' . $data['size_name'] . '</option>';
				}
				foreach ($list as $ls) {
					echo '<option value=' . $ls['val'] . '>' . $ls['cap'] . '</option>';
				}
			} else {
				foreach ($list as $ls) {
					$select = $ls['val'] == $nilai ? 'selected' : '';
					echo '<option value=' . $ls['val'] . ' ' . $select . '>' . $ls['cap'] . '</option>';
				}
			}
			
	echo '	</select>';
}

function buat_inline_multi_select_color($label, $nama, $list, $nilai, $place)
{ 	
	echo '	
            <label for="' . $nama . '" >' . $label . '</label>
			<select name="' . $nama . '" class="select2" multiple="multiple" data-placeholder="' . $place . '" style="width: 100%;">';

			if (strpos($nilai, ',') == true) {
				$ex = explode(",", $nilai);
				foreach ($ex as $key) {
					global $mysqli;
					$query = $mysqli->query("SELECT * FROM color_product WHERE id='$key' ");
					$data = $query->fetch_array();
					echo '<option value=' . $key . ' selected>' . $data['color_name'] . '</option>';
				}
				foreach ($list as $ls) {
					echo '<option value=' . $ls['val'] . '>' . $ls['cap'] . '</option>';
				}
			} else {
				foreach ($list as $ls) {
					$select = $ls['val'] == $nilai ? 'selected' : '';
					echo '<option value=' . $ls['val'] . ' ' . $select . '>' . $ls['cap'] . '</option>';
				}
			}
			
	echo '	</select>';
}

function buat_inline_multi_select_category($label, $nama, $list, $nilai, $place)
{ 	
	echo '	
            <label for="' . $nama . '" >' . $label . '</label>
			<select name="' . $nama . '" class="select2" multiple="multiple" data-placeholder="' . $place . '" style="width: 100%;">';

			if (strpos($nilai, ',') == true) {
				$ex = explode(",", $nilai);
				foreach ($ex as $key) {
					global $mysqli;
					$query = $mysqli->query("SELECT * FROM category_product WHERE id='$key' ");
					$data = $query->fetch_array();
					echo '<option value=' . $key . ' selected>' . $data['category_name'] . '</option>';
				}
				foreach ($list as $ls) {
					echo '<option value=' . $ls['val'] . '>' . $ls['cap'] . '</option>';
				}
			} else {
				foreach ($list as $ls) {
					$select = $ls['val'] == $nilai ? 'selected' : '';
					echo '<option value=' . $ls['val'] . ' ' . $select . '>' . $ls['cap'] . '</option>';
				}
			}
			
	echo '	</select>';
}

function buat_inline_multi_select($label, $nama, $list, $nilai, $place)
{
	echo '	
            <label for="' . $nama . '" >' . $label . '</label>
			<select name="' . $nama . '" class="select2" multiple="multiple" data-placeholder="' . $place . '" style="width: 100%;">';

			if (strpos($nilai, ',') == true) {
				$ex = explode(",", $nilai);
				foreach ($ex as $v) {
					$select = $list[$v]['val'] == $v ? 'selected' : '';
					echo '<option value=' . $list[$v]['val'] . ' ' . $select . '>' . $list[$v]['cap'] . '</option>';
				}
				foreach ($list as $ls) {
					echo '<option value=' . $ls['val'] . ' >' . $ls['cap'] . '</option>';
				}
			} else {
				foreach ($list as $ls) {
					$select = $ls['val'] == $nilai ? 'selected' : '';
					echo '<option value=' . $ls['val'] . ' ' . $select . '>' . $ls['cap'] . '</option>';
				}
			}
			
	echo '	</select>';
}

function buat_inline_select($label, $nama, $list, $nilai)
{
	echo '
            <label for="' . $nama . '" >' . $label . '</label>
			<select name="' . $nama . '" class="form-control select2" style="width: 100%;">';
	foreach ($list as $ls) {
		$select = $ls['val'] == $nilai ? 'selected' : '';
		echo '<option value=' . $ls['val'] . ' ' . $select . '>' . $ls['cap'] . '</option>';
	}
	echo '	</select>';
}
function buat_inlinetutup_col()
{
	echo '</div>';
}
function buat_inlinetutup()
{
	echo '</div>';
}

function buat_combobox($label, $nama, $list, $nilai, $lebar = '4')
{
	echo '<div class="form-group" id="' . $nama . '">
			<label for="' . $nama . '" class="control-label">' . $label . ' (<a href="?content=kategori-program">Buat kategori baru</a>)</label>
			<div class="col-sm-' . $lebar . '">
			  <select class="form-control" name="' . $nama . '">';
	foreach ($list as $ls) {
		$select = $ls['val'] == $nilai ? 'selected' : '';
		echo '<option value=' . $ls['val'] . ' ' . $select . '>' . $ls['cap'] . '</option>';
	}
	echo '	  </select>
			</div>
		 </div>';
}


function buat_imagepicker($label, $nama, $nilai, $lebar = '4')
{
	?>
	<script type="text/javascript">
		$(function() {
			$('#modal-<?php echo $nama; ?>').on('hidden.bs.modal', function(e) {
				var url = $('#<?php echo $nama; ?>').val();
				if (url != "") $('.tampil-<?php echo $nama; ?>').html('<img src="../images/thumbs/' + url + '" width="150" style="margin-bottom: 10px">');
			})
		});
	</script>
<?php
	echo '<div class="form-group imagepicker">
			<label for="' . $nama . '" class="col-sm-' . $lebar . ' control-label">' . $label . '</label>
			<div class="col-sm-' . $lebar . '">
			<div class="tampil-' . $nama . '">';
	if ($nilai != "") echo '<img src="../images/thumbs/' . $nilai . '" width="150" style="margin-bottom: 10px">';
	echo '	</div>
			<div class="input-group">
			  <input type="text" class="form-control input-' . $nama . '" id="' . $nama . '" name="' . $nama . '" value="' . $nilai . '" readonly>
			  <a data-toggle="modal" data-target="#modal-' . $nama . '" class="input-group-addon btn btn-success pilih-' . $nama . '">...</a>
			</div>
			</div>
			<div class="modal fade" id="modal-' . $nama . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

				<div class="modal-dialog modal-lg" style="max-width: 1200px;">
					<div class="modal-content">
						<div class="modal-header" style="min-height: 16.43px;padding: 15px;border-bottom: 1px solid #e5e5e5;display:block">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">File Manager</h4>
						</div>
						<div class="modal-body">
							<iframe src="../filemanager/dialog.php?type=1&field_id=' . $nama . '&relative_url=1" width="100%" height="500" style="border: 0"></iframe>
						</div>
					</div>
				</div>
			</div>
		 </div>';
}

function tutup_form($link)
{
	echo '<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary">
					<i class="glyphicon glyphicon-floppy-disk"></i> Simpan 
				</button>
				<a class="btn btn-warning" href="' . $link . '">
					<i class="glyphicon glyphicon-arrow-left"></i> Batal 
				</a>
			</div>
		</div>
	</form>';
}
?>