<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resmi Tatil Sorgulama</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --accent-color: #f093fb;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-light: #f8fafc;
            --bg-white: #ffffff;
            --border-color: #e5e7eb;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --border-radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            padding: 20px;
            color: var(--text-dark);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--bg-white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="white" opacity="0.1"/><circle cx="80" cy="80" r="2" fill="white" opacity="0.1"/><circle cx="40" cy="60" r="1" fill="white" opacity="0.2"/><circle cx="70" cy="30" r="1.5" fill="white" opacity="0.15"/></svg>');
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .content {
            padding: 2rem;
        }

        .form-section {
            background: var(--bg-light);
            padding: 2rem;
            border-radius: var(--border-radius);
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 1rem;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group input {
            padding: 0.75rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--bg-white);
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn {
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            box-shadow: var(--shadow-md);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .table-section {
            background: var(--bg-white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .table-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .dataTables_wrapper {
            padding: 1.5rem;
        }

        .dataTables_length,
        .dataTables_filter {
            margin-bottom: 1rem;
        }

        .dataTables_filter input {
            padding: 0.5rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            margin-left: 0.5rem;
        }

        .dataTables_filter input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        #holidayTable {
            width: 100% !important;
            border-collapse: collapse;
        }

        #holidayTable thead th {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
            color: white !important;
            padding: 1rem !important;
            font-weight: 600;
            text-align: left;
            border: none !important;
        }

        #holidayTable tbody tr {
            transition: all 0.3s ease;
        }

        #holidayTable tbody tr:hover {
            background-color: var(--bg-light);
            transform: scale(1.02);
        }

        #holidayTable tbody td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .holiday-name {
            font-weight: 600;
            color: var(--text-dark);
        }

        .holiday-date {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .holiday-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-left: 0.5rem;
        }

        .badge-national {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
        }

        .badge-religious {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .badge-half-day {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .loading-state {
            text-align: center;
            padding: 3rem;
            color: var(--text-light);
        }

        .loading-spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 4px solid var(--border-color);
            border-radius: 50%;
            border-top-color: var(--primary-color);
            animation: spin 1s ease-in-out infinite;
            margin-bottom: 1rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--text-light);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .error-state {
            text-align: center;
            padding: 3rem;
            color: var(--error-color);
        }

        .error-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--bg-white);
            padding: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stat-label {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .content {
                padding: 1rem;
            }
            
            .form-section {
                padding: 1rem;
            }
        }

        .dataTables_paginate .paginate_button {
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            background: var(--bg-white);
            color: var(--text-dark);
            transition: all 0.3s ease;
        }

        .dataTables_paginate .paginate_button:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .dataTables_paginate .paginate_button.current {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-calendar-alt"></i> Resmi Tatil Sorgulama</h1>
            <p>Türkiye'deki resmi tatiller ve dini bayramları sorgulayın</p>
        </div>

        <div class="content">
            <div class="form-section">
                <form id="holidayForm">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="start">
                                <i class="fas fa-calendar-day"></i>
                                Başlangıç Tarihi
                            </label>
                            <input type="date" id="start" name="start" required>
                        </div>
                        <div class="form-group">
                            <label for="end">
                                <i class="fas fa-calendar-week"></i>
                                Bitiş Tarihi
                            </label>
                            <input type="date" id="end" name="end" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                            Sorgula
                        </button>
                    </div>
                </form>
            </div>

            <div id="statsSection" class="stats-grid" style="display: none;">
                <div class="stat-card">
                    <div class="stat-number" id="totalHolidays">0</div>
                    <div class="stat-label">Toplam Tatil</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="nationalHolidays">0</div>
                    <div class="stat-label">Resmi Bayram</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="religiousHolidays">0</div>
                    <div class="stat-label">Dini Bayram</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="halfDayHolidays">0</div>
                    <div class="stat-label">Yarım Gün</div>
                </div>
            </div>

            <div class="table-section">
                <div class="table-header">
                    <i class="fas fa-list"></i> Tatil Listesi
                </div>
                <table id="holidayTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th><i class="fas fa-star"></i> Bayram / Tatil Adı</th>
                            <th><i class="fas fa-calendar-day"></i> Başlangıç</th>
                            <th><i class="fas fa-calendar-check"></i> Bitiş</th>
                            <th><i class="fas fa-clock"></i> Süre</th>
                        </tr>
                    </thead>
                    <tbody id="resultBody">
                        <tr>
                            <td colspan="4" class="empty-state">
                                <i class="fas fa-search"></i>
                                <div>Tarih aralığı seçerek tatilleri sorgulayabilirsiniz</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        let dataTable = null;

        // Sayfa yüklendiğinde bugünün tarihini başlangıç olarak ayarla
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const endOfYear = new Date(today.getFullYear(), 11, 31);
            
            document.getElementById('start').value = today.toISOString().split('T')[0];
            document.getElementById('end').value = endOfYear.toISOString().split('T')[0];
        });

        function getHolidayType(summary) {
            const lowerSummary = summary.toLowerCase();
            if (lowerSummary.includes('yarım gün') || lowerSummary.includes('arifesi')) {
                return 'half-day';
            } else if (lowerSummary.includes('ramazan') || lowerSummary.includes('kurban') || lowerSummary.includes('ramadan')) {
                return 'religious';
            } else {
                return 'national';
            }
        }

        function getHolidayBadge(type) {
            switch(type) {
                case 'half-day':
                    return '<span class="holiday-badge badge-half-day">Yarım Gün</span>';
                case 'religious':
                    return '<span class="holiday-badge badge-religious">Dini Bayram</span>';
                case 'national':
                    return '<span class="holiday-badge badge-national">Resmi Bayram</span>';
                default:
                    return '';
            }
        }

        function calculateDuration(start, end) {
            const startDate = new Date(start);
            const endDate = new Date(end);
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            if (diffDays === 1) {
                return '1 gün';
            } else if (diffDays === 0) {
                return 'Aynı gün';
            } else {
                return `${diffDays} gün`;
            }
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('tr-TR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        }

        function updateStats(data) {
            const stats = {
                total: data.length,
                national: 0,
                religious: 0,
                halfDay: 0
            };

            data.forEach(holiday => {
                const type = getHolidayType(holiday.summary);
                switch(type) {
                    case 'national':
                        stats.national++;
                        break;
                    case 'religious':
                        stats.religious++;
                        break;
                    case 'half-day':
                        stats.halfDay++;
                        break;
                }
            });

            document.getElementById('totalHolidays').textContent = stats.total;
            document.getElementById('nationalHolidays').textContent = stats.national;
            document.getElementById('religiousHolidays').textContent = stats.religious;
            document.getElementById('halfDayHolidays').textContent = stats.halfDay;
            
            document.getElementById('statsSection').style.display = 'grid';
        }

        document.getElementById('holidayForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const start = document.getElementById('start').value;
            const end = document.getElementById('end').value;
            const tableBody = document.getElementById('resultBody');

            // Yükleniyor durumu
            tableBody.innerHTML = `
                <tr>
                    <td colspan="4" class="loading-state">
                        <div class="loading-spinner"></div>
                        <div>Tatiller yükleniyor...</div>
                    </td>
                </tr>
            `;

            try {
                const response = await fetch(`http://192.168.6.52:8000/get_holidays.php?start=${start}&end=${end}`);
                if (!response.ok) throw new Error("Sunucudan geçerli yanıt alınamadı.");

                const data = await response.json();
                
                // Debug: Konsola gelen veriyi yazdır
                console.log('API\'den gelen veri:', data);
                console.log('Toplam kayıt sayısı:', data.length);

                if (data.length === 0) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="4" class="empty-state">
                                <i class="fas fa-calendar-times"></i>
                                <div>Bu tarihler arasında resmi tatil veya bayram bulunamadı.</div>
                            </td>
                        </tr>
                    `;
                    document.getElementById('statsSection').style.display = 'none';
                    return;
                }

                // Tarihe göre sırala
                data.sort((a, b) => new Date(a.start) - new Date(b.start));

                // İstatistikleri güncelle
                updateStats(data);

                // DataTable varsa önce yok et
                if (dataTable) {
                    dataTable.destroy();
                    dataTable = null;
                }

                // Tabloyu temizle
                tableBody.innerHTML = "";

                // Her veriyi tabloya ekle
                data.forEach((holiday, index) => {
                    const type = getHolidayType(holiday.summary);
                    const badge = getHolidayBadge(type);
                    const duration = calculateDuration(holiday.start, holiday.end);
                    
                    console.log(`${index + 1}. tatil ekleniyor:`, holiday.summary);
                    
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>
                            <div class="holiday-name">${holiday.summary}</div>
                            ${badge}
                        </td>
                        <td class="holiday-date">${formatDate(holiday.start)}</td>
                        <td class="holiday-date">${formatDate(holiday.end)}</td>
                        <td class="holiday-date">${duration}</td>
                    `;
                    tableBody.appendChild(row);
                });

                console.log('Tabloya eklenen satır sayısı:', tableBody.children.length);

                // DataTable'ı başlat
                dataTable = new DataTable('#holidayTable', {
                    pageLength: 50, // Daha fazla kayıt göster
                    lengthMenu: [10, 25, 50, 100, -1], // "Tümünü göster" seçeneği ekle
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/tr.json'
                    },
                    order: [[1, 'asc']],
                    columnDefs: [
                        { orderable: false, targets: 3 }
                    ],
                    dom: 'Blfrtip', // Butonları ekle
                    searching: true,
                    paging: true,
                    info: true
                });

                console.log('DataTable başlatıldı');

            } catch (err) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="error-state">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>Hata oluştu: ${err.message}</div>
                        </td>
                    </tr>
                `;
                document.getElementById('statsSection').style.display = 'none';
            }
        });
    </script>

</body>

</html>