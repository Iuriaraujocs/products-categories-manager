{extends file="layout/layout.tpl"} 

{block name="mainsite"}
    <!-- Main Content -->
    <main class="content">
        
        <div class="header-list-page">
            <h1 class="title">Dashboard</h1>
        </div>
    
        <div class="infor">
            You have {$countProducts} products added on this store: <a href="addProduct" class="btn-action">Add new Product</a>
        </div>
        
        <ul class="product-list">
            {foreach name=products from=$product item=item}
            <li>
                <div class="product-image">
                    <a href="tenis-basket-light.html" title="{$item['name']}">
                    <img src="/product-send-image/{$item['id']}" layout="responsive" width="164" height="145" alt="{$item['name']}" />
                    </a>
                </div>
                <div class="product-info">
                    <div class="product-name"><span>{$item['name']}</span></div>
                    <div class="product-price"><span class="special-price">{$item['amount']} available</span> <span>R${$item['price']}</span></div>
                </div>
            </li>
            {/foreach}
        </ul>
    </main>
    <!-- Main Content -->
{/block}