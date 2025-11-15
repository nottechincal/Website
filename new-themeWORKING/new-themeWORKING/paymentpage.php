<?php
/*
Template Name: Payment Page
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Payment</title>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #555;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 2px solid #df4a43;
        }
        h1 {
            color: #df4a43;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .paypal-button {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Complete Your Payment</h1>
        <?php
        if (isset($_GET['booking_id'])) {
            global $wpdb;
            $booking_id = intval($_GET['booking_id']);
            
            // Fetch booking details from the database
            $table_name = $wpdb->prefix . 'bookings';
            $booking = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $booking_id));
            
            if ($booking) {
                $service_type = esc_html($booking->service_type);
                $amount = ($service_type === 'Business Solution') ? '100.00' : '80.00';

                echo "<p>Please review your booking details and proceed to payment.</p>";
                echo "<p><strong>Name:</strong> " . esc_html($booking->name) . "</p>";
                echo "<p><strong>Date:</strong> " . esc_html($booking->booking_date) . "</p>";
                echo "<p><strong>Time:</strong> " . esc_html($booking->booking_time) . "</p>";
                echo "<p><strong>Address:</strong> " . esc_html($booking->address) . "</p>";
                echo "<p><strong>Service Type:</strong> " . esc_html($booking->service_type) . "</p>";
                echo "<p><strong>Amount Due:</strong> $" . $amount . "</p>";
                ?>
                
                <!-- PayPal Button -->
                <div id="paypal-button-container"></div>
                <script src="https://www.paypal.com/sdk/js?client-id=Acb7bJ5TYHBQObeTN-j6rKtT7EW2gb6KVOwg4d3KJMckl05aTblqIGAb3DIGZeGBeABGrDId4zhf2pie&currency=AUD"></script>
                <script>
                    paypal.Buttons({
                        createOrder: function(data, actions) {
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: '<?php echo $amount; ?>' // Set the amount here based on the service type
                                    }
                                }]
                            });
                        },
                        onApprove: function(data, actions) {
                            return actions.order.capture().then(function(details) {
                                alert('Transaction completed by ' + details.payer.name.given_name);
                                // Redirect to thank you or confirmation page
                                window.location.href = "<?php echo home_url('/thank-you'); ?>";
                            });
                        }
                    }).render('#paypal-button-container');
                </script>

                <?php
            } else {
                echo "<p>Invalid booking ID. Please check your email for the correct link.</p>";
            }
        } else {
            echo "<p>No booking ID provided. Please check your email for the correct link.</p>";
        }
        ?>
    </div>
</body>
</html>
