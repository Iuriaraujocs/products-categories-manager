{extends file="layout/layout.tpl"} 

{block name="mainsite"}
      <!-- Main Content -->
  <main class="content">
    <div class="header-list-page">
      <h1 class="title">Categories</h1>
      <a href="addCategory" class="btn-action">Add new Category</a>
    </div>
    <table class="data-grid">
      <tr class="data-row">
        <th class="data-grid-th">
            <span class="data-grid-cell-content">Name</span>
        </th>
        <th class="data-grid-th">
            <span class="data-grid-cell-content">Code</span>
        </th>
        <th class="data-grid-th">
            <span class="data-grid-cell-content">Actions</span>
        </th>
      </tr>
      <tr class="data-row">
        <td class="data-grid-td">
           <span class="data-grid-cell-content">Category 1 Name</span>
        </td>
      
        <td class="data-grid-td">
           <span class="data-grid-cell-content">Category 1 Code</span>
        </td>
      
        <td class="data-grid-td">
          <div class="actions">
            <div class="action edit"><span>Edit</span></div>
            <div class="action delete"><span>Delete</span></div>
          </div>
        </td>
      </tr>
      <tr class="data-row">
        <td class="data-grid-td">
           <span class="data-grid-cell-content">Category 2 Name</span>
        </td>
      
        <td class="data-grid-td">
           <span class="data-grid-cell-content">Category 2 Code</span>
        </td>
      
        <td class="data-grid-td">
          <div class="actions">
            <div class="action edit"><span>Edit</span></div>
            <div class="action delete"><span>Delete</span></div>
          </div>
        </td>
      </tr>
    </table>
  </main>
  <!-- Main Content -->
{/block}