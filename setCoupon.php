<?php require 'connection.php';
$uid = $_SESSION['USER_ID'];
$coupon = $_POST['FinalcouponCode'];
$amount = $_POST['rechargeAmt'];
$billerType = $_POST['billerType'];
$response = '';
$balanceUse = '';
$type1 = '';
if ($billerType == 'prepaid_recharge')
{
    $type1 = 'prepaid recharge';
}
else if ($billerType == 'dth_recharge')
{
    $type1 = 'dth recharge';
}
else
{
}
if ($coupon != '')
{
    $checkCoupon = mysqli_num_rows(mysqli_query($con, "select * from coupons where code='$coupon' and status=1"));
    if ($checkCoupon > 0)
    {
        $prevBal = mysqli_fetch_assoc(mysqli_query($con, "select * from wallet where user_id='$uid' order by `wallet`.`id` desc limit 1"));
        $prevUpdatedBal = $prevBal['updated_balance'];
        $prevUpdatedCashback = $prevBal['updated_cashback'];
        $getCoupon = mysqli_fetch_assoc(mysqli_query($con, "select * from coupons where code='$coupon' and status=1"));
        $isCouponUserAlready = mysqli_num_rows(mysqli_query($con, "select * from wallet where user_id='$uid' and coupon_code='" . $getCoupon['code'] . "'"));
        $coupon_expiry = $getCoupon['expired_on'];
        $today_date = date("Y-m-d");
        if ($today_date > $coupon_expiry)
        {
            $response = "expired coupon";
        }
        else
        {
            if ($getCoupon['status'] != 1)
            {
                $response = "not active coupon";
            }
            else
            {
                if ($getCoupon['type1'] != $type1)
                {
                    $response = "invalid coupon";
                }
                else
                {
                    if ($getCoupon['min_order_value'] > $amount)
                    {
                        $response = "Amount must be greater than " . $getCoupon['min_order_value'];
                    }
                    else
                    {
                        if ($getCoupon['usage_time'] <= $isCouponUserAlready)
                        {
                            $response = "coupon limit reach";
                        }
                        else if (isset($_SESSION['rechOperatorType']) && $_SESSION['rechOperatorType'] == 'postpaid')
                        {
                            $response = "only for prepaid recharge";
                        }
                        else
                        {
                            if($billerType == 'prepaid_recharge'){

                                if (isset($_SESSION['rechOperator']) && $getCoupon['operator_for'] == $_SESSION['rechOperator'] && $getCoupon['operator_for'] == 'airtel')
                                {
                                    if ($getCoupon['type2'] == 'percentage')
                                    {
                                        $discountAmountTemp = round(($getCoupon['value'] / 100) * $amount);
                                        $discountAmount = ($discountAmountTemp > $getCoupon['max_discount']) ? $getCoupon['max_discount'] : $discountAmountTemp;
                                    }
                                    else
                                    {
                                        $discountAmount = ($getCoupon['value'] > $getCoupon['max_discount']) ? $getCoupon['max_discount'] : $getCoupon['value'];
                                        $newBal = $prevUpdatedBal + $amount + $discountAmount;
                                        $newcb = $prevUpdatedCashback + $discountAmount;
                                    }
                                    $response = "proceed";
                                    $balanceUse = $getCoupon['balance_use'];
                                    $_SESSION['coupon'] = $coupon;
                                    $_SESSION['coupon_discount'] = $discountAmount;
                                }
                                else if (isset($_SESSION['rechOperator']) && $getCoupon['operator_for'] == 'all' && $_SESSION['rechOperator'] != 'airtel')
                                {
                                    if ($getCoupon['type2'] == 'percentage')
                                    {
                                        $discountAmountTemp = round(($getCoupon['value'] / 100) * $amount);
                                        $discountAmount = ($discountAmountTemp > $getCoupon['max_discount']) ? $getCoupon['max_discount'] : $discountAmountTemp;
                                    }
                                    else
                                    {
                                        $discountAmount = ($getCoupon['value'] > $getCoupon['max_discount']) ? $getCoupon['max_discount'] : $getCoupon['value'];
                                        $newBal = $prevUpdatedBal + $amount + $discountAmount;
                                        $newcb = $prevUpdatedCashback + $discountAmount;
                                    }
                                    $response = "proceed";
                                    $balanceUse = $getCoupon['balance_use'];
                                    $_SESSION['coupon'] = $coupon;
                                    $_SESSION['coupon_discount'] = $discountAmount;
                                }
                                else if ($getCoupon['operator_for'] == $type1)
                                {
                                    if ($getCoupon['type2'] == 'percentage')
                                    {
                                        $discountAmountTemp = round(($getCoupon['value'] / 100) * $amount);
                                        $discountAmount = ($discountAmountTemp > $getCoupon['max_discount']) ? $getCoupon['max_discount'] : $discountAmountTemp;
                                    }
                                    else
                                    {
                                        $discountAmount = ($getCoupon['value'] > $getCoupon['max_discount']) ? $getCoupon['max_discount'] : $getCoupon['value'];
                                        $newBal = $prevUpdatedBal + $amount + $discountAmount;
                                        $newcb = $prevUpdatedCashback + $discountAmount;
                                    }
                                    $response = "proceed";
                                    $balanceUse = $getCoupon['balance_use'];
                                    $_SESSION['coupon'] = $coupon;
                                    $_SESSION['coupon_discount'] = $discountAmount;
                                }
                                else
                                {
                                    $response = "not for " . $_SESSION['rechOperator'];
                                }
                            }

                            if($billerType == 'dth_recharge'){
                                if ($getCoupon['type2'] == 'percentage')
                                {
                                    $discountAmountTemp = round(($getCoupon['value'] / 100) * $amount);
                                    $discountAmount = ($discountAmountTemp > $getCoupon['max_discount']) ? $getCoupon['max_discount'] : $discountAmountTemp;
                                }
                                else
                                {
                                    $discountAmount = ($getCoupon['value'] > $getCoupon['max_discount']) ? $getCoupon['max_discount'] : $getCoupon['value'];
                                    $newBal = $prevUpdatedBal + $amount + $discountAmount;
                                    $newcb = $prevUpdatedCashback + $discountAmount;
                                }
                                $response = "proceed";
                                $balanceUse = $getCoupon['balance_use'];
                                $_SESSION['coupon'] = $coupon;
                                $_SESSION['coupon_discount'] = $discountAmount;
                            }
                        }
                    }
                }
            }
        }
    }
    else
    {
        $response = "Coupon Does Not Exists";
    }
}
$data = array(
    'response' => strtolower($response) ,
    'balanceUse' => $balanceUse
);
header('Content-Type: application/json;charset=utf-8');
echo json_encode($data);
?>
