<script type="text/javascript">
function getExtension(filename) {
    return filename.split('.').pop().toLowerCase();
}

function checkFile(inputFile) {
    var valid_extensions = /(.pdf)$/i;
    if(!valid_extensions.test(inputFile.value)) {
        alert('Loai file ko hop le!');
        inputFile.value = '';
    } else if(inputFile.files[0].size > 2048){ //2M
        alert('kich thuoc file qua lon!');
        inputFile.value = '';
    }
}
</script>


<?php
echo $this->Html->script('upload');
echo $this->Form->create('TSV', array('type' => 'file', 'enctype' => 'multipart/form-data', 'onsubmit' => 'return validation(this, "pdf")'));
?>

<label>Title: </label><input type="text" id="fileTitle" name="data[Document][fileTitle1]"/>
<input size="20" type="file" name="data[Document][file1]" onchange="checkFile(this)"/>
<div id="AddFileInputBox">
</div>
<label>Files
<span class="small"><a href="#" id="AddMoreFileBox">Add More Files</a></span>
</label>

<?php
echo $this->Form->end('Upload');
?>

<script type="text/javascript">
var maxFile = 5;
var FileInputsHolder = $('#AddFileInputBox');
var i = $("#AddFileInputBox").size() + 1;


$("#AddMoreFileBox").click(function()
{
    alert(i);
    if ($("span").size() < maxFile) {
        $('<span><br><br><label>Title: </label><input type="text" id="fileTitle" name="data[Document][fileTitle'+ i +']"/><input type="file" size="20" onchange="checkFile(this)" name="data[Document][file' + i +
        ']" class="addedInput" value=""/><a href="#" class="removeclass small2">Delete'+
        '</a></span>').appendTo(FileInputsHolder);
        i++;    
    }
});

$("body").on("click", ".removeclass", function(e) {
if (i > 1) {
$(this).parents('span').remove();
}

});
</script>