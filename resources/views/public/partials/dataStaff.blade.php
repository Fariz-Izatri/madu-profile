@if(isset($profilSekolah) && is_array($profilSekolah->daftar_staff) && count($profilSekolah->daftar_staff) > 0)
<div class="staff-team py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h2>Data Staff</h2>
                    <p>Tim Tenaga Kependidikan SDN Medokan Ayu II</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($profilSekolah->daftar_staff as $staff)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="staff-card">
                    <div class="staff-image">
                        @if(!empty($staff['foto']))
                            <img src="{{ $staff['foto'] }}" alt="{{ $staff['nama'] ?? 'Staff' }}" class="img-fluid">
                        @else
                            <img src="{{ asset('images/default-staff.png') }}" alt="{{ $staff['nama'] ?? 'Staff' }}" class="img-fluid">
                        @endif
                    </div>
                    <div class="staff-details">
                        <h4>{{ $staff['nama'] ?? 'Staff' }}</h4>
                        @if(!empty($staff['jabatan']))
                            <p>{{ $staff['jabatan'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<style>
    .staff-team {
        background-color: #f5f5f5;
    }
    .section-title h2 {
        font-weight: 700;
        position: relative;
        margin-bottom: 15px;
        padding-bottom: 15px;
        color: #333;
    }
    .section-title h2:after {
        content: "";
        position: absolute;
        width: 50px;
        height: 3px;
        background: #4a6baf;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
    }
    .section-title p {
        font-size: 18px;
        color: #666;
        margin-bottom: 40px;
    }
    
    .staff-card {
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .staff-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }
    
    .staff-image {
        overflow: hidden;
        height: 260px;
        position: relative;
    }
    
    .staff-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .staff-card:hover .staff-image img {
        transform: scale(1.05);
    }
    
    .staff-details {
        padding: 15px;
        text-align: center;
        border-top: 3px solid #4a6baf;
    }
    
    .staff-details h4 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
    }
    
    .staff-details p {
        font-size: 14px;
        color: #666;
        margin-bottom: 0;
    }
</style>

<script>
// Check if default-staff.png exists, if not create it dynamically
document.addEventListener('DOMContentLoaded', function() {
    // Check if any images are broken
    document.querySelectorAll('.staff-image img').forEach(function(img) {
        img.onerror = function() {
            // Create a canvas with initials if image fails to load
            var canvas = document.createElement('canvas');
            canvas.width = 300;
            canvas.height = 300;
            var ctx = canvas.getContext('2d');
            
            // Fill background
            ctx.fillStyle = '#4a6baf';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            // Add text
            var name = img.alt || 'Staff';
            var initials = name.split(' ').map(function(n) { return n[0]; }).join('').toUpperCase();
            if (initials.length > 2) initials = initials.substr(0, 2);
            
            ctx.font = 'bold 120px Arial';
            ctx.fillStyle = '#ffffff';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(initials, canvas.width/2, canvas.height/2);
            
            // Replace the image
            img.src = canvas.toDataURL('image/png');
        };
    });
});
</script> 