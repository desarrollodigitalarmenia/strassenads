<section id="pricing-table" class="section-padding" style="padding-top: 100px;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="section-title">Lista de Categorías</h2>
      </div>
      <?php if($cities): ?>
      <?php foreach($cities as $city): ?>
      <div class="col-lg-3 col-6">
        <div class="table">
          <div class="icon">
            <i class="lni-layers"></i>
          </div>
          <div class="title">
            <a href="<?= site_url() ?>city/<?= $region; ?>/<?= $city['name_short']; ?>"><h3><?= $city['name']; ?></h3></a>
          </div>
        </div> 
      </div>
      <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>