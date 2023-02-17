<section id="pricing-table" class="section-padding" style="padding-top: 100px;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="section-title">Lista de Categorías</h2>
      </div>
      <?php if($categories): ?>
      <?php foreach($categories as $category): ?>
      <div class="col-lg-3 col-6">
        <div class="table">
          <div class="icon">
            <i class="lni-layers"></i>
          </div>
          <div class="title">
            <a href="<?= site_url() ?>subcategories/<?= $category['name_short']; ?>"><h3><?= $category['name']; ?></h3></a>
          </div>
        </div> 
      </div>
      <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>