<div id="list-masters">
    <div class="btn-group" style="float: right" >
        <button class="btn btn-lg btn-info dropdown-toggle" data-toggle="dropdown">Выберите город <span class="caret"></span></button>
        <ul class="dropdown-menu cities">
            <li><a class="city" style="color:#000" href="#">city1</a></li>    
            <li><a class="city" style="color:#000" href="#">city2</a></li>           
            <li><a class="city" style="color:#000" href="#">city3</a></li>           
        </ul>
    </div>
</div>
<div class="res">
    kl
</div>


<script>
    $(function () {

        var city;
        $('#list-masters .city').on('click', function () {
            city = $(this).text();
            if (city) {
                alert(city);
                $.ajax({
                    type: "GET",
                    data: 'city=' + city,
                    url: '/index.php/user/index',
                    success: function (msg) {
                        console.log(msg.city);
                        $('.res').html(msg);
                    },
                    error: function () {
                        alert('error');
                    }
                });
            }
        });
    });


</script>