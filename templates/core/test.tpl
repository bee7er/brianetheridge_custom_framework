<script type="text/javascript">
var mode = '{$mode}';
var basePath = '{$basePath}';
{literal}

    var newUserId = '';

	function runTest() {
        getTest_GetUsers();
        postTest_PostUsers();
        putTest_PutUsers();
        deleteTest_DeleteUsers();
        getTest_GetUsers();
	}

    function deleteTest_DeleteUsers() {
        var userId = newUserId;
        var url = basePath+'api/deleteUser/'+userId;
        //alert(url);
        $.ajax({
            type: 'DELETE',
            contentType: 'application/json',
            dataType: 'json',
            url: url,
            async: false,
            success: function(x, data){
                if (data) {
                    alert('Delete result: '+data);
                } else {
                    alert('No data');
                }
            },
            error: function(){
                alert('DELETE error');
            }
        });
        return;
    }

    function putTest_PutUsers() {
        var userId = newUserId;
        var url = basePath+'api/updateUser/'+userId;
        var users = [];
        //alert(url);
        $.ajax({
            type: 'PUT',
            contentType: 'application/json',
            dataType: 'json',
            url: url,
            data: formToJSON_UpdateUser(),
            async: false,
            success: function(x, data){
                if (data) {
                    alert('Update result: '+data);
                } else {
                    alert('No data');
                }
            },
            error: function(){
                alert('PUT error');
            }
        });
        return;
    }
    function formToJSON_UpdateUser() {
        return JSON.stringify({
            "first_name": "Frankly"
        });
    }

    function postTest_PostUsers() {
        var url = basePath+'api/addUser';
        //alert(url);
        $.ajax({
            type: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            url: url,
            data: formToJSON_AddUser(),
            async: false,
            success: function(data){
                if (data) {
                    alert('Add result: '+data);
                    newUserId = data;
                } else {
                    alert('No data');
                }
            },
            error: function(){
                alert('POST error');
            }
        });
        return;
    }
    function formToJSON_AddUser() {
        return JSON.stringify({
            "first_name": "Zipperty",
            "surname": "Doodar"
        });
    }

    function getTest_GetUsers() {
        var url = basePath+'api/getUsers';
        var users = [];
        //alert(url);
        $.ajax({
            type: 'GET',
            contentType: 'application/json',
            dataType: 'json',
            url: url,
            async: false,
            success: function(getData){
                if (getData) {
                    alert('Get result. Count of users: '+getData.length);
                    /*
                    for (var i=0; i<getData.length; i++) {
                        alert('Got back User id: '+getData[i].user_id);
                    }
                    */
                    // Returned data array
                    users = getData;
                } else {
                    alert('No data');
                }
            },
            error: function(){
                alert('GET error');
            }
        });
        return users;
    }

    function getTest_GetLoggedInUser() {
        var url = basePath+'api/getLoggedInSessionId';
        var userId = '';
        //alert(url);
        $.ajax({
            type: 'GET',
            contentType: 'application/json',
            dataType: 'json',
            url: url,
            async: false,
            success: function(data){
                if (data) {
                    alert('Get result: '+data);
                    userId = data;
                } else {
                    alert('No data');
                }
            },
            error: function(){
                alert('GET error');
            }
        });
        return userId;
    }

    //var sessionUserId = getTest_GetLoggedInUser();
    //alert('Logged in: '+sessionUserId);
{/literal}
</script>

<h1>Test Harness</h1>
<div>Currently testing setting the step status. See source for more details.</div>
<input type="button" value="Run Test" onclick="runTest();" class="btnTurq" />