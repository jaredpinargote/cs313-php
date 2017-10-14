$(document).ready(function(){
    console.log("Ready");
    init();
    function checkForNewPlayers() {
        var gid = localStorage.gameID;
        $.get("playersInGame.php?gameID="+gid, function(data, status){
            // viewPlayersList
            // console.log(data);
            // var json = $.parseJSON(data);
            var players = "";
            $.each(data, function(id, name){
                if(name != undefined)
                    players += "<li>"+name+"</li>";
            })
            $("#viewPlayersList").html(players);
        });
    }
    $(function () {
        setInterval(checkForNewPlayers, 5000);
    });
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
            $("#viewLSVList").append("<li>"+index+": "+value+"</li>");
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
        );
    });
    $("button#viewDrawing").click(function(){
        var playerID = localStorage.playerID;
        var gameID = localStorage.gameID;
        var request = "drawingIDs.php?playerID=" + playerID
                        + "&gameID=" + gameID;
        $("#viewResult").html("Drawing:<br>");
        $.get(request, function(data, status){
            // var obj = $.parseJSON(data);
            // console.log("Drawing IDs: "+data);
            $.each(data, function( index, id ) {
                console.log("Running ID " + id);
                var img = $("<img />").attr('src', 'viewDrawing.php?drawingID='+id)
                .on('load', function() {
                    if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
                        console.log('broken image!');
                    } else {
                        // console.log("appending image with id " + id);
                        $("#viewResult").append(img);
                    }
                });
                // $("#viewLSVList").append("<li>"+index+": "+value+"</li>");
            });
        });
    });
    $("button#newCaption").click(function(){
        var cap = $("#caption").val();
        $.ajax({
            type: "POST",
            url: "newCaption.php",
            data: { 
                playerID: localStorage.playerID,
                gameID: localStorage.gameID,
                caption: cap,
            }
        }).done(function(data) {
            console.log(data['message']); 
        });
    });
    $("button#viewCaptions").click(function(){
        var gameID = localStorage.gameID;
        var request = "gameCaptions.php?gameID=" + gameID;
        // $("#viewResult").html("Drawing:<br>");
        $.get(request, function(data, status){
            // var obj = $.parseJSON(data);
            console.log("Captions: "+data);
            $.each(data, function( index, json ) {
                console.log("Json? " + json);
                $.each(json, function( index, value ) {
                    console.log(index + ": " + value);
                });
                $("#viewCaptionResult").append(json.caption + "<br>");
            });
        });
    });
});