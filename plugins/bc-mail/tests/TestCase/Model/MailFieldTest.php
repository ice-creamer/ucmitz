<?php
// TODO : コード確認要
return;
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) baserCMS Users Community <https://basercms.net/community/>
 *
 * @copyright       Copyright (c) baserCMS Users Community
 * @link            https://basercms.net baserCMS Project
 * @package         Mail.Test.Case.Model
 * @since           baserCMS v 3.0.0
 * @license         https://basercms.net/license/index.html
 */

App::uses('MailField', 'Mail.Model');

/**
 * @property MailField $MailField
 */
class MailFieldTest extends BaserTestCase
{

    public $fixtures = [
        'baser.Default.SiteConfig',
        'plugin.mail.Default/MailMessage',
        'plugin.mail.Default/MailConfig',
        'plugin.mail.Default/MailField',
        'plugin.mail.Default/MailField',
    ];

    public function setUp()
    {
        $this->MailField = ClassRegistry::init('Mail.MailField');
        parent::setUp();
    }

    public function tearDown()
    {
        unset($this->MailField);
        parent::tearDown();
    }

    /**
     * validate
     */
    public function test正常チェック()
    {
        $this->MailField->create([
            'MailField' => [
                'name' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234',
                'field_name' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234',
                'mail_content_id' => 999,
                'type' => 'type',
                'head' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234',
                'attention' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234',
                'before_attachment' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234',
                'after_attachment' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234',
                'options' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234',
                'class' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234',
                'separator' => 'separator',
                'default_value' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234',
                'description' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234',
                'group_field' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234',
                'group_valid' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234',
            ]
        ]);

        $this->assertTrue($this->MailField->validates());
        $this->assertEmpty($this->MailField->validationErrors);
    }

    public function test空白チェック()
    {
        $this->MailField->create([
            'MailField' => [
                'name' => '',
                'type' => '',
            ]
        ]);

        $this->assertFalse($this->MailField->validates());

        $expected = [
            'name' => ['項目名を入力してください。'],
            'type' => ['タイプを入力してください。'],
        ];
        $this->assertEquals($expected, $this->MailField->validationErrors);
    }


    public function test桁数チェック()
    {
        $this->MailField->create([
            'MailField' => [
                'name' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345',
                'field_name' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345',
                'mail_content_id' => 999,
                'type' => 'type',
                'head' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345',
                'attention' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345',
                'before_attachment' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345',
                'after_attachment' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345',
                'options' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345',
                'class' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345',
                'separator' => 'separator',
                'default_value' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345',
                'description' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345',
                'group_field' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345',
                'group_valid' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345',
            ]
        ]);
        $this->assertFalse($this->MailField->validates());

        $expected = [
            'name' => ['項目名は255文字以内で入力してください。'],
            'field_name' => ['フィールド名は255文字以内で入力してください。'],
            'head' => ['項目見出しは255文字以内で入力してください。'],
            'attention' => ['注意書きは255文字以内で入力してください。'],
            'before_attachment' => ['前見出しは255文字以内で入力してください。'],
            'after_attachment' => ['後見出しは255文字以内で入力してください。'],
            'options' => ['オプションは255文字以内で入力してください。'],
            'class' => ['クラス名は255文字以内で入力してください。'],
            'default_value' => ['初期値は255文字以内で入力してください。'],
            'description' => ['説明文は255文字以内で入力してください。'],
            'group_field' => ['グループフィールドは255文字以内で入力してください。'],
            'group_valid' => ['グループ入力チェックは255文字以内で入力してください。']
        ];

        $this->assertEquals($expected, $this->MailField->validationErrors);
    }


    public function test半角英数チェック()
    {
        $this->MailField->create([
            'MailField' => [
                'field_name' => '１２３ａｂｃ',
            ]
        ]);
        $this->assertFalse($this->MailField->validates());

        $expected = [
            'field_name' => ['フィールド名は半角英数字のみで入力してください。'],
        ];
        $this->assertEquals($expected, $this->MailField->validationErrors);
    }

    public function test重複チェック()
    {
        $this->MailField->create([
            'MailField' => [
                'field_name' => 'name_1',
                'mail_content_id' => 1,
            ]
        ]);
        $this->assertFalse($this->MailField->validates());

        $expected = [
            'field_name' => ['入力されたフィールド名は既に登録されています。'],
        ];
        $this->assertEquals($expected, $this->MailField->validationErrors);
    }

    /**
     * コントロールソースを取得する
     */
    public function testGetControlSource()
    {
        $this->markTestIncomplete('このテストは、まだ実装されていません。');
    }

    /**
     * 同じ名称のフィールド名がないかチェックする
     * 同じメールコンテンツが条件
     */
    public function testDuplicateMailField()
    {
        $this->markTestIncomplete('このテストは、まだ実装されていません。');
    }

    /**
     * メールフィールドの値として正しい文字列か検証する
     * 半角英数-_
     */
    public function testHalfTextMailField()
    {
        $this->markTestIncomplete('このテストは、まだ実装されていません。');
    }

    /**
     * 選択リストの入力チェック
     */
    public function testSourceMailField()
    {
        $this->markTestIncomplete('このテストは、まだ実装されていません。');
    }

    /**
     * フィールドデータをコピーする
     *
     * @param int $id
     * @param array $data
     * @param array $sortUpdateOff
     * @param array $expected 期待値
     * @dataProvider copyDataProvider
     */
    public function testCopy($id, $data, $sortUpdateOff)
    {
        $options = ['sortUpdateOff' => $sortUpdateOff];
        $result = $this->MailField->copy($id, $data, $options);

        if ($id) {
            $this->assertEquals('姓漢字_copy', $result['MailField']['name'], '$idからコピーができません');
            if (!$sortUpdateOff) {
                $this->assertEquals(19, $result['MailField']['sort'], 'sortを正しく設定できません');
            } else {
                $this->assertEquals(1, $result['MailField']['sort'], 'sortを正しく設定できません');
            }
        } else {
            $this->assertEquals('hogeName_copy', $result['MailField']['name'], '$dataからコピーができません');
            if (!$sortUpdateOff) {
                $this->assertEquals(19, $result['MailField']['sort'], 'sortを正しく設定できません');
            } else {
                $this->assertEquals(999, $result['MailField']['sort'], 'sortを正しく設定できません');
            }
        }
    }

    public function copyDataProvider()
    {
        return [
            [1, [], false],
            [false, ['MailField' => [
                'mail_content_id' => 1,
                'field_name' => 'name_1',
                'name' => 'hogeName',
                'sort' => 999,
            ]], false],
            [1, [], true],
            [false, ['MailField' => [
                'mail_content_id' => 1,
                'field_name' => 'name_1',
                'name' => 'hogeName',
                'sort' => 999,
            ]], true],
        ];
    }

    /**
     * After Delete
     */
    public function testAfterDelete()
    {
        $this->markTestIncomplete('このテストは、まだ実装されていません。');
    }

    /**
     * After Save
     */
    public function testAfterSave()
    {
        $this->markTestIncomplete('このテストは、まだ実装されていません。');
    }

    /**
     * testFormatSource
     * @dataProvider formatSourceDataProvider
     */
    public function testFormatSource($source, $expected)
    {
        $result = $this->MailField->formatSource($source);
        $this->assertEquals($expected, $result);
    }

    public function formatSourceDataProvider()
    {
        return [
            ["  １|２|３|４|５", "１\n２\n３\n４\n５"],
            ["１|２ ３|４|５", "１\n２ ３\n４\n５"],
            ["\r１|\r２|３|４|５", "１\n２\n３\n４\n５"],
            ["１\n２\n３\n４\n５", "１\n２\n３\n４\n５"],
            ["１|\n２|３|４|５", "１\n\n２\n３\n４\n５"]
        ];
    }
}
