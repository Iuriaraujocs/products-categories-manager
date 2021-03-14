{extends file="layout/layout.tpl"} 

{block name="mainsite"}
    <!-- Main Content -->
    <main class="content">
        <h1 class="title new-item">New Category</h1>
    
        <form id='id-form-add-category'>
            <div class="input-field">
                <label for="category-name" class="label">Category Name</label>
                <input type="text" id="id-category-name" class="input-text" required/>
            </div>

            <div class="input-field">
                <label for="category-code" class="label">Category Code</label>
                <input type="text" id="id-category-code" class="input-text" required/>
            </div>

            <div class="actions-form">
                <a href="categories" class="action back">Back</a>
                <input id='id-button-submit-category' class="btn-submit btn-action"  type="submit" value="Save" />
            </div>
        </form>
  </main>
  <!-- Main Content -->
{/block}