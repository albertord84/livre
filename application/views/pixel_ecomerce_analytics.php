<script>
    window.dataLayer = window.dataLayer || []
    dataLayer.push({
       'transactionId': '<?php echo $transactionId?>',
       'transactionAffiliation': '<?php echo $transactionAffiliation?>',
       'transactionTotal': '<?php echo $transactionTotal?>',
//       'transactionTax': 1.29,
//       'transactionShipping': 5,
       'transactionProducts': [{
           'name': '<?php echo $solicited_value?>', //valor tomado
           'sku': 'DD44',
           'category': '<?php echo amount_months?>', //numero de parcelas
           'price': '<?php echo $solicited_value?>', //valor tomado
           'quantity': 1
       }]
    });
</script>