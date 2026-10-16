<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>
        Quotation Document #<?= (int) ($queue['quotation_id'] ?? 0); ?>
    </title>

<style>
    *{box-sizing:border-box}
    html,body{margin:0;width:100%;min-height:100%;font-family:Arial,sans-serif;background:#e9ecef}
    .document-toolbar{position:sticky;top:0;z-index:10;min-height:70px;padding:12px 24px;background:#fff;border-bottom:1px solid #ddd;display:flex;align-items:center;justify-content:space-between;gap:15px;box-shadow:0 2px 7px rgba(0,0,0,.10)}
    .document-title{margin:0;font-size:18px;color:#222}
    .document-meta{margin-top:5px;font-size:13px;color:#666}
    .download-button{display:inline-block;padding:11px 20px;background:#1974d2;color:#fff;text-decoration:none;border-radius:6px;font-size:14px;font-weight:600;white-space:nowrap}
    .download-button:hover{background:#125ba7}
    .document-preview-area{width:100%;padding:25px 40px 45px}
    .document-paper{width:100%;max-width:1200px;margin:0 auto;background:#fff;border-radius:4px;box-shadow:0 3px 18px rgba(0,0,0,.16);overflow:hidden}
    .document-frame{display:block;width:100%;height:calc(100vh - 125px);min-height:750px;border:0;background:#fff}
    @media(max-width:768px){
        .document-toolbar{padding:12px 15px;flex-direction:column;align-items:stretch}
        .download-button{text-align:center}
        .document-preview-area{padding:15px 10px 30px}
        .document-frame{height:calc(100vh - 160px);min-height:600px}
    }

    .print-button{display:inline-block;padding:11px 20px;background:#198754;color:#fff;border:0;border-radius:6px;font-size:14px;font-weight:600;white-space:nowrap;cursor:pointer}
    .print-button:hover{background:#146c43}
    .document-actions{display:flex;align-items:center;gap:10px}
    @media(max-width:768px){
        .document-actions{flex-direction:column;align-items:stretch}
        .print-button,.download-button{text-align:center;width:100%}
    }
</style>
</head>

<body>
    <div class="document-toolbar">
        <div>
            <h1 class="document-title">Quotation Document</h1>
            <div class="document-meta">
                Quotation ID: <?= (int)($queue['quotation_id'] ?? 0); ?>
                &nbsp;|&nbsp;
                Enquiry ID: <?= (int)($queue['enquiry_id'] ?? 0); ?>
            </div>
        </div>

        <button type="button" class="print-button" onclick="printQuotationDocument()">
            Print Document
        </button>

        <a href="<?= html_escape($download_url); ?>" class="download-button">
            Download DOC File
        </a>

        <!-- <a href="<?php //echo html_escape($pdf_download_url); ?>" class="download-button pdf-button">
            Download PDF File
        </a> -->
    </div>

    <div class="document-preview-area">
        <div class="document-paper">
            <iframe
                src="<?= html_escape($render_url); ?>"
                class="document-frame"
                title="Quotation document preview"
            ></iframe>
        </div>
    </div>
</body>
</html>
<script>
    function printQuotationDocument(){
        const iframe=document.querySelector('.document-frame');

        if(!iframe){
            alert('Quotation preview not found.');
            return;
        }

        try{
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        }catch(error){
            console.error('Print error:',error);
            alert('Document could not be printed.');
        }
    }
</script>