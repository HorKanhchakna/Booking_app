<!DOCTYPE html>
<html>
<head>
    <style>
        .tabs { display: flex; }
        .tab-btn { padding: 10px; cursor: pointer; }
        .tab-btn.active { font-weight: bold; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
    </style>
</head>
<body>
    <div class="tabs">
        <button class="tab-btn active" data-tab="t1">Tab 1</button>
        <button class="tab-btn" data-tab="t2">Tab 2</button>
    </div>
    <div class="tab-content active" id="t1">Content 1</div>
    <div class="tab-content" id="t2">Content 2</div>
    <script>
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                btn.classList.add('active');
                document.getElementById(btn.dataset.tab).classList.add('active');
            });
        });
    </script>
</body>
</html>
