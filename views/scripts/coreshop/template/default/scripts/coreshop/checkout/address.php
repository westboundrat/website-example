<div class="container shop checkout checkout-step-3">
    
    <?=$this->partial("coreshop/helper/order-steps.php", array("step" => 3));?>
    
    <?php
        $addresses = \CoreShop::getTools()->getUser()->getAddresses();
    ?>
    
    <?php foreach($addresses as $address) { ?>
        <div class="hidden" id="address-<?=$address->getId()?>">
            <?=$this->partial("coreshop/checkout/helper/address.php", array("address" => $address))?>
        </div>
    <?php } ?>



    <div class="panel">
        <div class="panel-body">
            <!-- Form Starts -->
            <form action="<?=\CoreShop::getTools()->url(array("lang" => $this->language, "act" => "address"), "coreshop_checkout", true)?>" method="post">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="shippingAddress"><?=$this->translate("Choose a shipping address")?>:</label>
                            <select class="form-control" id="shipping-address" name="shipping-address">
                                <?php foreach ($addresses as $address) { ?>
                                    <option data-value="<?=$address->getId()?>" value="<?=$address->getId()?>"><?=$address->getName()?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-6 billing-address-selector" style="display:none">
                        <label for="billingAddress"><?=$this->translate("Choose a billing address")?>:</label>
                        <div class="form-group">
                            <select class="form-control" id="billing-address" name="billing-address">
                                <?php foreach ($addresses as $address) { ?>
                                    <option data-value="<?=$address->getId()?>" value="<?=$address->getId()?>"><?=$address->getName()?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group form-group-no-border">
                            <label for="useShippingAsBilling">
                                <input type="checkbox" name="useShippingAsBilling" checked="checked" />
                                <?=$this->translate("Use the shipping address as the billing address.")?></label>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="panel panel-smart">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <?=$this->translate("Shipping Address")?>
                                </h4>
                            </div>
                            <div class="panel-body panel-delivery-address">
                                <?=$this->partial("coreshop/checkout/helper/address.php", array("address" => reset($addresses)))?>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6">
                        <div class="panel panel-smart">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <?=$this->translate("Billing Address")?>
                                </h4>
                            </div>
                            <div class="panel-body panel-billing-address">
                                <?=$this->partial("coreshop/checkout/helper/address.php", array("address" => reset($addresses)))?>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <a href="<?=\CoreShop::getTools()->url(array("lang" => $this->language, "act" => "address", "redirect" => \CoreShop::getTools()->url(array("lang" => $this->language, "act" => "address"))), "coreshop_user", true)?>" class="btn btn-default pull-left">
                            <?=$this->translate("Add a new Address")?>
                        </a>

                        <button type="submit" class="btn btn-default pull-right">
                            <?=$this->translate("Proceed to checkout")?>
                        </button>
                    </div>
                </div>

            </form>
            <!-- Form Ends -->
        </div>
    </div>

</div>