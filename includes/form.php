    <form action="pdf.php" method="POST">
        <div class="form-group">
            <label for="airline">Airlines</label><br>
                <select class="form-control" name="airline">
                    <?php foreach($airlines as $key){
                        echo "<option value='$key'>$key</option>";                       
                    } ?> 
                </select><br>        
        </div>
        <div class="form-group">
            <label for="airportDeparture">Departure place</label><br>
                <select class="form-control" name="airportDeparture">
                    <?php foreach($airports as $key =>$value){
                        $ports = $value['name'];
                        echo "<option value='$ports'>$ports</option>";                       
                    } ?> 
                </select><br>      
        </div>
        <div class="form-group">
            <label for="airportArrival">Arrival place</label><br>
                <select class="form-control" name="airportArrival">
                    <?php foreach($airports as $key =>$value){
                        $ports = $value['name'];
                        echo "<option value='$ports'>$ports</option>";                       
                    } ?>    
                </select><br>
        </div>
        <div class="form-group">
            <label for="dateTime">Date and Time of departure (firefox not support this type of input ?)</label><br> <!--  firefox nie wspiera datetime-local-->
                <input type="datetime-local" name="dateTime" class="form-control" placeholder="time"><br>
        </div>
        <div class="form-group">
            <label for="hours">Flight duration</label><br>
                <input type="number" name="hours" class="form-control" placeholder="flight time" min="0" step="1"><br>
        </div>
        <div class="form-group">    
            <label for="price">Price</label><br>
                <input type="number" name="price" class="form-control" placeholder="price" min="0" step="0.01"><br>
        </div>    
        <button type="submit" class="btn btn-primary" name="reserwation">Reserve</button><br>     
    </form>