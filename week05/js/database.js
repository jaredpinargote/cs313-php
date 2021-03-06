$(document).ready(function(){
    console.log("Ready");
    init();
    function checkForNewPlayers() {
        var gid = localStorage.gameID;
        $.get("playersInGame.php?gameID="+gid, function(data, status){
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
            console.log("Data:"+data['gameID']);
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
        var results = "";
        // $("#viewCaptionResult").html("");
        $.get(request, function(data, status){
            // var obj = $.parseJSON(data);
            console.log("Captions: "+data);
            $.each(data, function( index, json ) {
                console.log("Json? " + json);
                $.each(json, function( index, value ) {
                    console.log(index + ": " + value);
                });
                results += json.name + " wrote: " + json.caption + "<br>";
            });
            $("#viewCaptionResult").html(results);
        });
    });
    $("button#viewComboOptions").click(function(){
        var gameID = localStorage.gameID;
        var request = "gameComboOptions.php?gameID=" + gameID;
        var results = "";
        // $("#viewCaptionResult").html("");
        $.get(request, function(data, status){
            // var obj = $.parseJSON(data);
            console.log("Drawings: "+data.drawingIDs);
            console.log("Captions: "+data.captionIDs);
            var results = "";
            $.each(data, function( index, json ) {
                console.log("Json? " + json);
                results += index + ":<br>";
                $.each(json, function( index, value ) {
                    console.log(index + ": " + value.id);
                    results += value.id + "<br>";
                });
            });
            $("#viewComboOptionResult").html(results);
        });
    });
    $("button#newCombo").click(function(){
        console.log("New Combo...!");
        var drawingID = $("#drawingID").val();
        var captionID = $("#captionID").val();
        var playerID = localStorage.playerID;
        var gameID = localStorage.gameID;
        var request = "newCombo.php?drawingID=" + drawingID
                        + "&captionID=" + captionID
                        + "&playerID=" + playerID
                        + "&gameID=" + gameID;
        $.get(request, function(data, status){
            console.log("Message:"+data['message']);
            console.log("ComboID:"+data['comboID']);
            localStorage.comboID = data['comboID'];
        });
    });
    $("button#viewCombos").click(function(){
        // console.log("New Combo...!");
        var request = "viewGameCombos.php?gameID=" + localStorage.gameID;
        $.get(request, function(data, status){
            console.log("Combos:"+data);
            $.each(data, function( index, combo ) {
                // viewCombosResult
                var img = $("<img />").attr('src', 'viewDrawing.php?drawingID='+combo.drawingID)
                .on('load', function() {
                    if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
                        console.log('broken image!');
                    } else {
                        // console.log("appending image with id " + id);
                        $("#viewCombosResult").append(img);
                        $("#viewCombosResult").append("<br>Caption: " + combo.caption);
                        $("#viewCombosResult").append("<br>Drawing creator: " + combo.drawingPlayerName);
                        $("#viewCombosResult").append("<br>Caption creator: " + combo.captionPlayerName);
                        $("#viewCombosResult").append("<br>Combo Creator: " + combo.comboPlayerName + "<br><br>");
                    }
                });
            });
            // $('#comboInsertResult').html("Player ID: " + data['id']
            //     + " Combo ID: " + data['gameID']);
            // localStorage.playerID = data['id'];
            // localStorage.playerName = data['name']
        });
    });
});