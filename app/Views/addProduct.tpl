{extends file="layout/layout.tpl"} 

{block name="mainsite"}
    
      <!-- Main Content -->
  <main class="content">
    <h1 class="title new-item">New Product</h1>
    
    <form id='id-form-save-product'>
      <div class="input-field">
        <label for="sku" class="label">Product SKU</label>
        <input id='id-sku' type="text" id="sku" class="input-text" required /> 
      </div>
      <div class="input-field">
        <label for="name" class="label">Product Name</label>
        <input type="text" id="id-name" class="input-text" required/> 
      </div>
      
        <div class="input-field">
            <label for="name" class="label">Image do Produto</label>
            <input id='id-image-product' name="imgProduct" type="file" style='margin-top:13px;'/>
        </div>
      <div class="input-field">
        <label for="price" class="label">Price</label>
        <input type="text" id="id-price" class="input-text" required /> 
      </div>
      <div class="input-field">
        <label for="quantity" class="label">Quantity</label>
        <input type="text" id="id-quantity" class="input-text" required/> 
      </div>
      <div class="input-field">
        <label for="category" class="label">Categories</label>
        <select multiple id="id-category" class="input-text" required>
          
            {foreach name=categories from=$category key=id item=name}
	            <option value="{$id}" 
                    {if $smarty.foreach.categories.first}selected{/if}>
                    {$name}
                </option>
            {/foreach}
          
        </select>
      </div>
      <div class="input-field">
        <label for="description" class="label">Description</label>
        <textarea id="id-description" class="input-text" required></textarea>
      </div>
      <div class="actions-form">
        <a href="products" class="action back">Back</a>
        <button id='id-button-submit-product' class="btn-submit btn-action" type="submit">Save Product</button>
      </div>
      
    </form>
  </main>
  <!-- Main Content -->
  
{/block}