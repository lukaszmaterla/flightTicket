<?php
    require_once 'vendor/autoload.php';
    use NumberToWords\NumberToWords; 
    include('includes/airports.php');
    $airports = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['airportDeparture'] !== $_POST['airportArrival']){
            if (!empty($_POST['dateTime'])){
                if (!empty($_POST['hours'])){
                    if (!empty($_POST['price'])){
                        $airlines = $_POST['airline'];
                        $port1 = $_POST['airportDeparture'];
                        $port2 = $_POST['airportArrival'];             
                        $date = $_POST['dateTime'];
                        $hours = $_POST['hours'];
                        $faker = Faker\Factory::create();
                        $numberToWords = new NumberToWords();
                        $currencyTransformer = $numberToWords->getCurrencyTransformer('pl');
                        $fakeName = $faker->name;
                        //szukam petlą foreach odpowiedniego lotniska i dopisuje do zmiennej strefę czasową
                        foreach($airports as $k =>$p){
                            if ($p['name'] === $port1){
                                $zone1 = $p['timezone'];//wazne
                                $codePort1 = $p['code'];//wazne
                            }   
                        }
                        // var_dump($zone1); sprawdznie poprawnośći wyciągnietej strefy czasowej
                        //wykonuje to samo dla drugiego lotniska
                        foreach($airports as $k =>$p){
                            if ($p['name'] === $port2){
                                $zone2 = $p['timezone'];//wazne
                                $codePort2 = $p['code'];//Wazne
                            }   
                        };
                        //tworzę nowy obiekt klasy DateTime w strefie czasowej pierwszego lotniska z data podaną w formularzu
                        $portZone1 = new DateTime($date);    
                        //formatuje obiekt do formatu przedstawionego w zadaniu dla pierwszego lotniska WAZNE!
                        $dateFormat1 = $portZone1->format('d.m.Y H:i:s');
                        //tworzę zmienna przechowująca czas w tej samej strefie czasowej co pierwsze lotnisko tylko że z dodaniem czasu lotu  
                        $timeZone1afterAdd = $portZone1->modify("+$hours hours");
                        //tworze obietk klasy datetimezone w strefie czasowej drugiego lotniska
                        $z2 = new DateTimeZone($zone2);
                        //przekształcam czas policzony w stresie czasowej pierwszego lotniska z uwzględnieniem czasu lotu, na czas w strefie obiektu stworzonego na podstawie wcześniej wyznaczonej strefy czasowej
                        $timeZone1afterAdd->setTimezone($z2);
                        //przekształcam do odpowiedniego formatu czas w strefie drugiej i zapisuje do zmimennej WAZNE!
                        $dateFormat2 = $timeZone1afterAdd->format('d.m.Y H:i:s');
                        $price = $_POST['price']; 
                        $priceToWords = $currencyTransformer->toWords($price*100, 'PLN');
                        $mpdf = new mPDF(); 
                        $mpdf->WriteHTML("<!DOCTYPE html>
                        <html lang=\"en\">
                        <head>
                            <meta charset=\"UTF-8\">
                            <title>Formularz rejestracyjny</title>
                            <link rel=\"stylesheet\" href=\"style.css\">

                        </head>
                        <body>
                            <table autosize=\"1\">
                                <thead>
                                    <th colspan=\"2\" class =\"head\"><h2>$airlines</h2></th>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td colspan=\"2\"><h2>$airlines</h2></td>
                                    </tr>        

                                    <tr>
                                        <td style=\"width: 50%\"><h3>From<h3></td>
                                        <td><h3>To<h3></td>
                                    </tr>
                                    <tr>
                                        <td>$port1 <br>($codePort1)</td>
                                        <td>$port2 <br>($codePort2)</td>
                                    </tr>
                                    <tr>
                                        <td><h3>Departure(locla time)<h3></td>
                                        <td><h3>Arrival (local time)<h3></td>
                                    </tr>            
                                    <tr>
                                        <td>$dateFormat1<br>($zone1)</td>
                                        <td>$dateFormat2<br>($zone2)</td>
                                    </tr>            
                                    <tr>
                                        <td colspan=\"2\"><h3>Flight time<h3></td>
                                    </tr>
                                    <tr>
                                        <td colspan=\"2\">$hours hours</td>
                                    </tr>
                                    <tr>
                                        <td colspan=\"2\"><h3>Passenger<h3></td>
                                    </tr>            
                                    <tr>
                                        <td colspan=\"2\">$fakeName</td>
                                    </tr>
                                    <tr>
                                        <td colspan=\"2\"><h3>Price<h3></td>
                                    </tr>            
                                    <tr>
                                        <td colspan=\"2\">$price zł<br>$priceToWords</td>
                                    </tr>           
                                </tbody>
                            </table>
                        </body>
                        </html>");
                        $mpdf->Output("rezerwacja.pdf",'I');//pobiera z D a z I otwiera na nowej karcie przeglądarki
                    }else{
                        echo 'Podaj porawną cenę biletu.'.'<br>'; echo "<a href='index.php'>Back to reservation</a>"  ;                        
                    }
                } else{     
                    echo 'Podaj porawną długość lotu.'.'<br>';echo "<a href='index.php'>Back to reservation</a>";    
                }  
                
            }else{
                echo 'Podaj poprawną datę wylotu'.'<br>';echo "<a href='index.php'>Back to reservation</a>";
            }
   
        }else{   
            echo 'Podano takie same lotnisko wylotu i przylotu. Wybierz dwa różne lotniska'.'<br>';echo "<a href='index.php'>Back to reservation</a>";           
        }  
    }else{
        echo 'Nie można przetworzyć danych'.'<br>';echo "<a href='index.php'>Back to reservation</a>";
    }
