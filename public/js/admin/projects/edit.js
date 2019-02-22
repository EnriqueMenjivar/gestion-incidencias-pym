$(function(){
	$('[data-category]').on('click', editCaregoryModel);
	$('[data-level]').on('click', editLevelModel);
});

function editCaregoryModel(){
	//id
	var category_id = $(this).data('category');
	$('#category_id').val(category_id);

	//name
	var category_name = $(this).parent().prev().text();
	$('#category_name').val(category_name);

	//show
	$('#modalEditCategory').modal('show');
}

function editLevelModel(){
	//id
	var level_id = $(this).data('level');
	$('#level_id').val(level_id);

	//name
	var level_name = $(this).parent().prev().text();
	$('#level_name').val(level_name);

	//show
	$('#modalEditLevel').modal('show');
}
