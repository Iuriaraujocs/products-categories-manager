{extends file="layout/layout.tpl"} 

{block name="mainsite"}
    <!-- Main Content -->
    <main class="content">
        <div class="header-list-page">
            <h1 class="title">Products</h1>
            <a href="addProduct" class="btn-action">Add new Product</a>
        </div>

        <table class="data-grid">
            <tr class="data-row">
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Name</span>
                </th>
                
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">SKU</span>
                </th>
                
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Price</span>
                </th>
                
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Quantity</span>
                </th>
                
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Categories</span>
                </th>

                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Actions</span>
                </th>
            </tr>

            {foreach name=products from=$product item=item}
            <tr class="data-row">
                <td class="data-grid-td">
                    <span class="data-grid-cell-content">{$item['name']}</span>
                </td>
            
                <td class="data-grid-td">
                    <span class="data-grid-cell-content">{$item['sku']}</span>
                </td>

                <td class="data-grid-td">
                    <span class="data-grid-cell-content">R${$item['price']}</span>
                </td>

                <td class="data-grid-td">
                    <span class="data-grid-cell-content">{$item['amount']}</span>
                </td>

                <td class="data-grid-td">
                    <span class="data-grid-cell-content">
                    
                    {foreach name=cats from=$item['categories'] item=subitem}
                        {$subitem['name']}
                    
                        {if !$smarty.foreach.cats.last}
                            <br/>
                        {/if}
                    {/foreach}
                    </span>
                </td>

                <td class="data-grid-td">
                    <div class="actions">
                        <div class="action edit"><span>Edit</span></div>
                        <div class="action delete"><span>Delete</span></div>
                    </div>
                </td>
            </tr>
            {/foreach}
        </table>
    </main>
    <!-- Main Content -->
{/block}