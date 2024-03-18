<!DOCTYPE html>
<html>
<head>
    <title><?php echo e($settings['general']['site_title']); ?></title>
</head>
<style type="text/css">
    body{
        font-family: 'Roboto Condensed', sans-serif;
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;
    }
    .w-85{
        width:85%;
    }
    .w-15{
        width:15%;
    }
    .logo img{
        width:200px;
        height:60px;
    }
    .gray-color{
        color:#52a750a4;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
</style>
<body>
<div class="head-title">
    <h1 class="text-center m-0 p-0">Invoice</h1>
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Order Id - <span class="gray-color"><?php echo e($orders->order_number); ?></span></p>
        <p class="m-0 pt-5 text-bold w-100">Order Date - <span class="gray-color"><?php echo e($orders->created_at->format("d/m/Y")); ?></span></p>
        <p class="m-0 pt-5 text-bold w-100">Payment Method - <span class="gray-color"><?php echo e($orders->payment_method); ?></span></p>
    </div>
    <div style="clear: both;"></div>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Billing Address</th>
            <th class="w-50">Shipping Address</th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    <p><?php echo e($orders->billing_address->street); ?></p>
                    <p><?php echo e($orders->billing_address->pincode); ?>,</p>
                    <p><?php echo e($orders->billing_address->city); ?>,</p>
                    <p><?php echo e($orders->billing_address?->state->name); ?>, <?php echo e($orders->billing_address?->country->name); ?></p>
                    <p>Contact: (<?php echo e($orders->billing_address?->country_code); ?>) <?php echo e($orders->billing_address?->phone); ?></p>
                </div>
            </td>
            <td>
                <div class="box-text">
                    <p><?php echo e($orders->shipping_address->street); ?></p>
                    <p><?php echo e($orders->shipping_address->pincode); ?>,</p>
                    <p><?php echo e($orders->shipping_address->city); ?>,</p>
                    <p><?php echo e($orders->shipping_address?->state->name); ?>, <?php echo e($orders->shipping_address?->country->name); ?></p>
                    <p>Contact: (<?php echo e($orders->shipping_address?->country_code); ?>) <?php echo e($orders->shipping_address?->phone); ?></p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">No</th>
            <th class="w-50">Product Name</th>
            <th class="w-50">Price</th>
            <th class="w-50">Qty</th>
            <th class="w-50">Subtotal</th>
            <th class="w-50">Shipping Cost</th>
            <th class="w-50">Grand Total</th>
        </tr>
        <?php $__currentLoopData = $orders->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr align="center">
            <td><?php echo e(++$no); ?></td>
            <td><?php echo e($product->name); ?></td>
            <td>$ <?php echo e($product->pivot->single_price); ?></td>
            <td><?php echo e($product->pivot->quantity); ?></td>
            <td>$ <?php echo e($product->pivot->subtotal); ?></td>
            <td>$ <?php echo e($product->pivot->shipping_cost); ?></td>
            <td>$ <?php echo e($product->pivot->subtotal + $product->pivot->shipping_cost + $product->pivot->tax); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td colspan="7">
                <div class="total-part">
                    <div class="total-left w-85 float-left" align="right">
                        <p>Sub Total</p>
                        <p>Tax</p>
                        <p>Shipping</p>
                        <p>Total Payable</p>
                    </div>
                    <div class="total-right w-15 float-left text-bold" align="right">
                        <p>$<?php echo e($orders->amount); ?></p>
                        <p>$<?php echo e($orders->tax_total); ?></p>
                        <p>$<?php echo e($orders->shipping_total); ?></p>
                        <p>$<?php echo e($orders->total); ?></p>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </td>
        </tr>
    </table>
</div>
</html>
<?php /**PATH /home/zo1ro/Desktop/stackdeans/paperless-api-master/resources/views/emails/invoice.blade.php ENDPATH**/ ?>