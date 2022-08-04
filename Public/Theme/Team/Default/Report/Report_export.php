<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>
<?= '<?mso-application progid="Excel.Sheet"?>' ?>
<?= '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet" xmlns:html="https://www.w3.org/TR/html401/">' ?>
    <Worksheet ss:Name="CognaLearn+Intedashboard">
        <Table>
            <Column ss:Index="1" ss:AutoFitWidth="1" ss:Width="100"/>
            <Column ss:Index="2" ss:AutoFitWidth="1" ss:Width="100"/>
            <Column ss:Index="3" ss:AutoFitWidth="1" ss:Width="200"/>
            <Column ss:Index="4" ss:AutoFitWidth="1" ss:Width="200"/>
            <Column ss:Index="5" ss:AutoFitWidth="1" ss:Width="200"/>
            <Row>
                <Cell><Data ss:Type="String">日期</Data></Cell>
                <Cell><Data ss:Type="String">用户</Data></Cell>
                <Cell><Data ss:Type="String">报表详情</Data></Cell>
            </Row>

            <?php if (!empty($list)): ?>
                <?php foreach ($list as $date => $user): ?>
                    <Row>
                        <Cell><Data ss:Type="String"><?= $date ?></Data></Cell>
                    </Row>
                    <?php foreach ($user as $userID => $report): ?>
                        <Row>
                            <Cell><Data ss:Type="String"></Data></Cell>
                            <Cell><Data ss:Type="String"><?= $report['name'] ?></Data></Cell>
                            <?php foreach ($report['report'] as $key => $content): ?>
                                <Cell><Data ss:Type="String"><?= $content ?></Data></Cell>
                            <?php endforeach; ?>
                        </Row>
                    <?php endforeach; ?>

                    <Row>
                        <Cell><Data ss:Type="String"></Data></Cell>
                        <Cell><Data ss:Type="String"></Data></Cell>
                        <Cell><Data ss:Type="String"></Data></Cell>
                    </Row>

                <?php endforeach; ?>
            <?php endif; ?>
        </Table>
    </Worksheet>
</Workbook>
