<div>
    <form wire:submit.prevent="update" method="post">
        <input type="hidden" wire:model="product_id">
    
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" wire:model="name">
            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" rows="3" placeholder="Enter description" wire:model="description"></textarea>
            @error('description') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" wire:model="quantity">
            @error('quantity') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" placeholder="Enter price" wire:model="price">
            @error('price') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    
</div>