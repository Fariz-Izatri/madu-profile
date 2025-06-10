@if(isset($profilSekolah) && is_array($profilSekolah->daftar_guru) && count($profilSekolah->daftar_guru) > 0)
<div class="teacher-team py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h2>Data Guru</h2>
                    <p>Tim Pengajar SDN Medokan Ayu II</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($profilSekolah->daftar_guru as $guru)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="teacher-card">
                    <div class="teacher-image">
                        @if(!empty($guru['foto']))
                            <img src="{{ $guru['foto'] }}" alt="{{ $guru['nama'] ?? 'Guru' }}" class="img-fluid">
                        @else
                            <img src="{{ asset('images/default-teacher.png') }}" alt="{{ $guru['nama'] ?? 'Guru' }}" class="img-fluid">
                        @endif
                    </div>
                    <div class="teacher-details">
                        <h4>{{ $guru['nama'] ?? 'Guru' }}</h4>
                        @if(!empty($guru['jabatan']))
                            <p>{{ $guru['jabatan'] }}</p>
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
    .teacher-team {
        background-color: #f9f9f9;
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
    
    .teacher-card {
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .teacher-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }
    
    .teacher-image {
        overflow: hidden;
        height: 260px;
        position: relative;
    }
    
    .teacher-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .teacher-card:hover .teacher-image img {
        transform: scale(1.05);
    }
    
    .teacher-details {
        padding: 15px;
        text-align: center;
        border-top: 3px solid #4a6baf;
    }
    
    .teacher-details h4 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
    }
    
    .teacher-details p {
        font-size: 14px;
        color: #666;
        margin-bottom: 0;
    }
</style>

<script>
// Check if default-teacher.png exists, if not create it dynamically
document.addEventListener('DOMContentLoaded', function() {
    // Check if any images are broken
    document.querySelectorAll('.teacher-image img').forEach(function(img) {
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
            var name = img.alt || 'Guru';
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