<div>
<div class="container" style="padding: 30px 0;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-md-6">
                          Add new Slide
                      </div>
                      <div class="col-md-6">
                          <a href="<?php echo e(route('admin.homeslider')); ?>" class="btn btn-success pull-right">All Slides</a>
                      </div>
                  </div>
              </div>
              <div class="panel-body">
                  <?php if(Session::has('message')): ?>
                  <div class="alert alert-success" role="alert"><?php echo e(Session::get('message')); ?></div>
                  <?php endif; ?>
                  <form class="form-horizontal" wire:submit.prevent="addSlide">
                   <div class="form-group">
                       <label class="col-md-4 control-label">Title</label>
                       <div class="col-md-4">
                           <input type="text" placeholder="Title" class="form-control input-md" wire:model="title"/>
                       </div>
                   </div>

                   <div class="form-group">
                    <label class="col-md-4 control-label">Subtitle</label>
                    <div class="col-md-4">
                        <input type="text" placeholder="Subtitle" class="form-control input-md" wire:model="subtitle"/>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-4 control-label">Price</label>
                    <div class="col-md-4">
                        <input type="text" placeholder="Price" class="form-control input-md"wire:model="price"/>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-4 control-label">Link</label>
                    <div class="col-md-4">
                        <input type="text" placeholder="Link" class="form-control input-md"wire:model="link"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Image</label>
                    <div class="col-md-4">
                        <input type="file" class="input-file" wire:model="image"/>
                        <?php if($image): ?>
                        <img src="<?php echo e($image->temporaryUrl()); ?>" width="120"/>
                        <?php endif; ?>
                    </div>
                </div>
                   

                <div class="form-group">
                    <label class="col-md-4 control-label">Status</label>
                    <div class="col-md-4">
                    <select class="form-control" wire:model="status">
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>


                  </form>
              </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php /**PATH /home/bachir/laravel8ecommerce/resources/views/livewire/admin/admin-add-home-slider-component.blade.php ENDPATH**/ ?>