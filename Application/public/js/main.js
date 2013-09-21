/* 
 * Main js file. This is where the all the action takes place.
 */

var ROOT_URL = 'http://rest.localhost/Rest/users';

(function() {

	// handle save click
    $('#save-btn').click(function() {
        var data = validateFormData();

        if (data.errors.length) {
            $('.error-msg').html('Following errors occured: ' + data.errors.join(' '));
        } else {
            $('.error-msg').html('');
            if (data.data[0] == '') {
                add(data.data[1], data.data[2]);
            } else {
                update(data.data[0], data.data[1], data.data[2]);
            }
        }
            
        return false;
    });
    
    // handle load button click
	$('#load-btn').click(function() {
        getAll();
		return false;
    });
    
	// handle delete button click
    $('#delete-btn').click(function() {
        var id = $('#id').val();
        remove(id);
        return false;
    });
    
    getAll();
	
	// handle form validation
    function validateFormData() {
        var id, name, price;
        var errors = [];
        var data = [];
        id = $('#id').val();
        name = $('#name').val();
        price = $('#price').val();

        data.push(id);
        data.push(name);
        data.push(price);

        if (name == '') {
            errors.push('No name defined.');
        }
        
        if (price == '') {
            errors.push('No Price defined.');
        }
        var dataset = new dataSet();
		dataset.errors = errors;
		dataset.data = data;
		return dataset;
    }

	var dataSet = function() {
		var data;
		var errors;
		
		this.setErrors = function(errors) {
			this.errors = errors;
		};

		this.getErrors = function() {
			return this.errors;
		};

		this.setData = function(data) {
			this.data = data;
		};

		this.getData = function() {
			return this.data;
		};

	}
    
	// get the resource by id
    function getById(id) {
        this.id  = id || 1;
        var get = createAjaxCall('GET', {id : id});
        $.ajax(get);
    }
    
	// get all the data
    function getAll() {
        var get = createAjaxCall('GET', {});
        var dataSet = [];
        get.success = function(data) {
            for (i in data.data) {
                var statement = data.data[i][0] + ' ' + data.data[i][1];
                dataSet.push(statement);
            }
            $('.box').html(dataSet.join('<br/>'));
        }
        
        $.ajax(get);
    }

    // add 
    function add(name, price) {
        var add = createAjaxCall('POST', {name : name, price : price});
        $.ajax(add);
    }
    
	// update
    function update(id, name, price) {
        var update = createAjaxCall('PUT', { name : name, price : price}, id);
        $.ajax(update);
        
    }
    
	// delete
    function remove(id) {
        var remove = createAjaxCall('DELETE', {id : id});
        $.ajax(remove);
    }
    
	// prepare the ajax call
    function createAjaxCall(method, data, id) {
		var id = '/' + id || '';
        var ajax = {
            type : method,
            url: ROOT_URL + id,
            data: JSON.stringify(data),
            dataType : 'json',
			processData: false,
			contentType: "application/json",
            success: renderSuccess,
            error: renderError
        };
        
        return ajax;
    }
    
	// display success messages
    function renderSuccess(data) {
		console.log(data);
        $('.box').html('Success! ' + data.message);
    }
    
	// display errors
    function renderError(data) {
		console.log(data);
        $('.box').html('sorry went really wrong!');
    }
})();
