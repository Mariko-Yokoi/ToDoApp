<!-- flatpickrスクリプト -->
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<!-- 日本語化のための追加スクリプト -->
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
<!-- flatpickrの機能を有効化 -->
<script>
  flatpickr(document.getElementById('due_date'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
</script>