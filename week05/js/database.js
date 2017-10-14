$(document).ready(function(){
    console.log("Rdy!!!");
    init();
    var source = new EventSource("eventTest.php");
    if(typeof(EventSource) !== "undefined") {
        console.log("Supported!!");
    } else {
        console.log("not supporeted :(");
    }
    source.onmessage = function(event) {
        if(event.data != 'wait'){
            console.log(event.data);
            $("#result").append(event.data + "<br>");
            var parseable = event.data.substring(1, event.data.length-1);
            var json = JSON.parse(parseable);
            console.log(json);
            $("#viewPlayersList").append("<li>"+json.name+"</li>")
        }
    };
    $("button#test").click(function(){
        $.get("gameManager.php", function(data, status){
            var obj = $.parseJSON(data);
            $('#display').html(obj.name);
        });
    });
    $("button#newGame").click(function(){
        console.log("Getting...!");
        $.get("newGame.php", function(data, status){
            // var obj = $.parseJSON(data);
            console.log("Data:"+data['gameID']);
            // var obj = $.parseJSON(data);
            $('#display').html("Game ID: " + data['gameID']
                + " Room Code: " + data['roomCode']);
            $('#viewPlayersRoomCode').html("Room Code: "
                + data['roomCode']);
            localStorage.roomCode = data['roomCode'];
            localStorage.gameID = data['gameID'];
        });
    });

    $("button#newPlayer").click(function(){
        console.log("New Player...!");
        var playerName = $("#playerName").val();
        var roomCode = $("#roomCode").val();
        var request = "newPlayer.php?playerName=" + playerName
                        + "&roomCode=" + roomCode;
        $.get(request, function(data, status){
            // var obj = $.parseJSON(data);
            console.log("Message:"+data['message']);
            // var obj = $.parseJSON(data);
            $('#playerInsertResult').html("Player ID: " + data['id']
                + " Game ID: " + data['gameID']
                + " Name: " + data['name']);
            localStorage.playerID = data['id'];
            localStorage.playerName = data['name']
        });
    });
    $("button#viewLSV").click(function(){
        $.each(localStorage, function( index, value ) {
            $("#viewLSVList").append("<li>"+index+":"+value+"</li>");
        });
    });
    $("button#newDrawing").click(function(){
        var dataURL = document.getElementById("sketchpad").toDataURL();
        $.ajax({
            type: "POST",
            url: "newDrawing.php",
            data: { 
                img: dataURL,
                playerID: localStorage.playerID,
                gameID: localStorage.gameID
            }
        }).done(function(data) {
            console.log(data['message']); 
        });
    });
    $("button#checkDrawVals").click(function(){
        var dataURL = document.getElementById("sketchpad").toDataURL();
        $("#drawValsOutput").html(
            "Player ID: " + localStorage.playerID + "<br>" +
            "Game ID: " + localStorage.gameID + "<br>" +
            "Data: " + dataURL
        )
    });
});