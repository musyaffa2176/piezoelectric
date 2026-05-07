<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Sensor Piezoelectric</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; }
        h2 { margin-bottom: 20px; font-weight: normal; }
        table { width: 100%; border-collapse: collapse; }
        th { 
            text-align: left; 
            padding: 12px 8px; 
            border-bottom: 2px solid #333; 
            font-size: 14px;
        }
        td { 
            padding: 12px 8px; 
            border-bottom: 1px solid #ddd; 
            font-size: 13px;
        }
        .text-muted { color: #666; }
    </style>
</head>
<body>

    <h2>Riwayat Sensor Piezoelectric (7 Hari Terakhir)</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Hari</th>
                <th>Tegangan Rata-rata</th>
                <th>Tekanan</th>
                <th>Energi Total</th>
                <th>Status Sistem</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $item)
            <tr>
                <td class="text-muted">#{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l') }}</td>
                <td>{{ number_format($item->tegangan, 2) }} V</td>
                <td>{{ $item->tekanan }} psi</td>
                <td>{{ number_format($item->energi, 1) }} W</td>
                <td>
                    @if($item->tegangan > 4.0) Maksimal
                    @elseif($item->tegangan > 3.5) Stabil
                    @else Normal @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>