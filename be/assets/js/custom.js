$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	
	$(".form-group").submit(function(){
		$(".btn_submit").attr("disabled", true);
	});
});

function del()
{
	var con = confirm("Do you want to delete this record");
	if(con == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function selectall(source)
{
	var checkboxes = document.getElementsByName("del_items[]");
	for(i in checkboxes)
	{
		checkboxes[i].checked = source.checked;
	}
}

function gotoURL(site)
{
	if (site !="")
	{
		self.location = site;
	}
}


function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode != 45  && charCode > 31 && (charCode < 48 || charCode > 57))
    return false;

    return true;
}
