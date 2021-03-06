<div id="main-container" class="container">
    <div class="row">
        <?=$this->template("coreshop/helper/left.php"); ?>
        <!-- Primary Content Starts -->
        <div class="col-md-9">
            <!-- Breadcrumb Starts -->
            <ol class="breadcrumb">
                <li><a href="<?=\CoreShop::getTools()->url(array("lang" => $this->language), "coreshop_index", true)?>"><?=$this->translate("Home")?></a></li>
                <?php foreach($this->category->getHierarchy() as $cat) { ?>
                    <li class="active"><a href="<?=$cat->getCategoryUrl($this->language);?>"><?=$cat->getName()?></a></li>
                <?php } ?>
            </ol>
            <!-- Breadcrumb Ends -->
            <!-- Main Heading Starts -->
            <h2 class="main-heading2">
                <?=$this->category->getName()?>
            </h2>
            <!-- Main Heading Ends -->
            <!-- Category Intro Content Starts -->
            <div class="row cat-intro">
                <div class="col-sm-3">
                    <?php if($this->category->getImage() instanceof \Pimcore\Model\Asset\Image) { ?>
                        <?php
                        $this->category->getImage()->getThumbnail("coreshop_categoryThumbnail")->getHtml(array("class" => "img-responsive img-thumbnail", "alt" => $this->category->getName()));
                        ?>
                    <?php } ?>
                </div>
                <div class="col-sm-9 cat-body">
                    <?=$this->category->getDescription()?>
                </div>
            </div>

            <div class="row cat-subs">
                <?php
                $subCategories = $this->category->getChildCategories();

                foreach($subCategories as $cat) {
                    ?>
                    <div class="col-sm-3">
                        <div class="image">
                            <?php if($cat->getImage() instanceof \Pimcore\Model\Asset\Image) { ?>
                                <a href="<?=$cat->getCategoryUrl($this->language);?>">
                                    <?php echo $cat->getImage()->getThumbnail("coreshop_categoryThumbnail")->getHtml(array("class" => "img-responsive"))?>
                                </a>
                            <?php } else { ?>
                                <a href="<?=$cat->getCategoryUrl($this->language);?>">
                                    <img src="<?=CORESHOP_TEMPLATE_RESOURCES?>images/category/placeholder.png" class="img-responsive img-thumbnail" />
                                </a>
                            <?php } ?>
                        </div>
                        <div class="caption">
                            <a href="<?=$cat->getCategoryUrl($this->language);?>">
                                <?=$cat->getName()?>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Category Intro Content Ends -->
            <!-- Product Filter Starts -->
            <div class="product-filter">
                <div class="row">
                    <div class="col-md-4">
                        <div class="display">
                            <a href="<?=substr(\CoreShop::getTools()->url(array("type" => "list")), 1)?>" class="<?=$this->type == "list" ? "active" : ""?>">
                                <i class="fa fa-th-list" title="" data-original-title="<?=$this->translate("List View")?>"></i>
                            </a>
                            <a href="<?=substr(\CoreShop::getTools()->url(array("type" => "grid")), 1)?>" class="<?=$this->type == "grid" ? "active" : ""?>">
                                <i class="fa fa-th" title="" data-original-title="<?=$this->translate("Grid View")?>"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-2 text-right">
                        <label class="control-label"><?=$this->translate("Sort")?></label>
                    </div>
                    <div class="col-md-3 text-right">
                        <?php
                        $sorting = array(
                            "NAME_DESC" => $this->translate("Name (A - Z)"),
                            "NAME_ASC" => $this->translate("Name (Z - A)"),
                            "PRICE_ASC" => $this->translate("Price ascending"),
                            "PRICE_DESC" => $this->translate("Price descending")
                        );
                        ?>
                        <select class="form-control site-reload" name="sort">
                            <?php foreach($sorting as $key=>$value) { ?>
                                <option value="<?=$key?>" <?=$this->sort == $key ? "selected" : ""?>><?=$value?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-1 text-right">
                        <label class="control-label"><?=$this->translate("Show")?></label>
                    </div>
                    <div class="col-md-2 text-right">
                        <select class="form-control site-reload" name="perPage">
                            <?php foreach($this->perPageAllowed as $perPage) { ?>
                            <option value="<?=$perPage?>" <?=$this->perPage == $perPage ? "selected" : ""?>><?=$perPage?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Product Filter Ends -->
            <!-- Product List Display Starts -->

            <div class="row">
                <?php
                $type = $this->type;

                foreach($this->paginator as $product) {
                    echo $this->template("coreshop/product/helper/product-$type.php", array("product" => $product));
                }
                ?>
            </div>
            <!-- Product List Display Ends -->
            <?= $this->paginationControl($this->paginator, 'Sliding', 'coreshop/helper/paging.php', array(
                'appendQueryString' => true
            )); ?>
        </div>
        <!-- Primary Content Ends -->
    </div>
</div>