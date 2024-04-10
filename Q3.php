<head>
    <style>
        input[type="number"] {
            width: 50px;
        }
        table {
            border-spacing: 10px;
            width: 100%;
        }
        th,
        td {
            text-align: center;
            vertical-align: middle;
        }
        td[id^="sub"] {
            text-align: right;
        }
    </style>
</head>
<body>
    <form>
    <table id="main">
        <tr>
            <th>Product name</th>
            <th>Quantity</th>
            <th>X</th>
            <th>Unit Price</th>
            <th> = </th>
            <th>Total</th>
        </tr>
        <tr>
            <td id="P1">Dry Line Marking Compound</td>
            <td><input type="number" name="P1" id="P1" data-price="165" min="0" max="999"></td>
            <td>X</td>
            <td>$165</td>
            <td>=</td>
            <td id="tP1">0</td>
        </tr>
        <tr>
            <td id="P2">Calcined Clay Soil conditioner</td>
            <td><input type="number" name="P2" id="P2" data-price="300" min="0" max="999" pattern="[0-9]*" title="Please enter a valid number"></td>
            <td>X</td>
            <td>$300</td>
            <td>=</td>
            <td id="tP2">0</td>
        </tr>
        <tr>
            <td id="P3">Clay top dressing</td>
            <td><input type="number" name="P3" id="P3" data-price="340" min="0" max="999" pattern="[0-9]*" title="Please enter a valid number"></td>
            <td>X</td>
            <td>$340</td>
            <td>=</td>
            <td id="tP3">0</td>
        </tr>
        <tr>
            <td id="P4">Red clay</td>
            <td><input type="number" name="P4" id="P4" data-price="410" min="0" max="999" pattern="[0-9]*" title="Please enter a valid number"></td>
            <td>X</td>
            <td>$410</td>
            <td>=</td>
            <td id="tP4">0</td>
        </tr>
        <tr>
            <td colspan="5" id="sub">product SUBTOTAL: </td>
            <td id="Total">$0</td>
        </tr>
    </table>
    </form>
    <script>
        var price=[165,300,340,410]
        function updateSubtotal() {
            var subtotal = 0;
            for (var i = 1; i <= 4; i++) {
                var quantity = document.getElementById('P' + i).value;
                console.log(quantity)
                if (!isNaN(quantity)) {
                    subtotal += Number(quantity) * price[i-1];
                }
            }
            console.log(subtotal.toFixed(2))
            document.getElementById('Total').innerHTML = '$' + String(subtotal.toFixed(2));
        }

        var inputElements = document.querySelectorAll('input[type="number"]');
        inputElements.forEach(function(inputElement) {
            inputElement.addEventListener('input', function() {
                var id = this.id.replace('P', 'tP');
                document.getElementById(id).innerHTML = this.value * this.getAttribute('data-price');
                updateSubtotal();
            });
        });

        updateSubtotal();
    </script>
</body>