<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;

class RestaurantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('ja_JP');

        $postalCodes = [
            '463-2029',
            '460-4710',
            '461-6942',
            '464-0534',
            '466-8116',
            '465-6438',
            '460-2763',
            '463-6052',
            '464-0825',
            '463-9515',
            '460-5077',
            '461-5169',
            '466-4955',
            '460-0509',
            '460-8048',
            '462-9668',
            '461-5322',
            '462-8940',
            '461-3585',
            '461-1763',
            '462-4460',
            '464-3426',
            '462-5604',
            '460-5241',
            '463-1416',
            '463-1718',
            '462-9292',
            '463-3975',
            '460-1265',
            '460-8084',
            '460-9904',
            '463-5481',
            '461-6824',
            '462-8514',
            '462-5772',
            '463-3492',
            '462-4395',
            '462-6270',
            '460-8757',
            '466-6214',
            '466-3931',
            '466-9100',
            '466-5573',
            '463-2172',
            '464-5029',
            '464-2567',
            '465-8861',
            '466-7817',
            '461-4837',
            '460-9333'
        ];

        $addresses = [
            '中西248-9',
            '国府町雨滝366-9',
            '早良区東入部2-909-19',
            '東川町１号南988-13',
            '日高川町滝頭191-5',
            '川北町上先出595-16',
            '大戸町小谷原636-14',
            '大山新490-9',
            '婦中町島本郷687-2',
            '山都町三津合942-2',
            '本田663-1',
            '杉戸町515-12',
            '邑楽町篠塚943-14',
            '半ノ木853-15',
            '餌差町4-358-14',
            '夢前町戸倉872-14',
            '勝木484-6',
            '安心院町内川野653-13',
            '葛川砂子沢703-18',
            '北会津町田村山817-17',
            '中里4-113-13',
            '浜中町三番沢464-13',
            '大信豊地113-2',
            '朝日町横水875-12',
            '朝日町窪田812-4',
            '幕別町千住903-7',
            '福上224-17',
            '南区釜室26-11',
            '米沢町418-9',
            '迫間231-18',
            '三坑町241-12',
            '久美浜町郷27-17',
            '早良区祖原274-15',
            '柱九番町582-15',
            '北丹町375-12',
            '上県町樫滝938-12',
            '神楽岡１条1-111-8',
            '吉海町福田927-6',
            '古浜1-535-2',
            '沢山814-12',
            '下郷町澳田371-17',
            '丸森町柏木335-13',
            '山中温泉今立町604-6',
            '武田2-898-1',
            '野辺地町米内沢974-9',
            '下舘野974-1',
            '釜ケ台16-3',
            '津和野町中川849-18',
            '猿賀上岡59-9',
            '八尾町小長谷832-19',
        ];

        $names = [
            "旬彩亭",
            "海鮮屋桜",
            "炭火焼肉牛角",
            "魚福",
            "寿司幸",
            "竹亭",
            "桜庵",
            "月の蕎麦",
            "銀座カレー工房",
            "梅林ラーメン",
            "鉄板焼太郎",
            "海の幸寿司",
            "桃山うどん",
            "極味焼肉",
            "春風亭",
            "鳥善",
            "花柳寿司",
            "明星ラーメン",
            "京風お好み焼き",
            "松のやとんかつ",
            "富士山うどん",
            "錦海鮮丼",
            "銀しゃり寿司",
            "天ぷら桜花",
            "炭火焼鳥幸",
            "虎ノ門ラーメン",
            "雲海すし",
            "源氏焼肉屋",
            "福の家カレー",
            "美味亭お好み焼き",
            "龍宮寿司",
            "桃谷ラーメン",
            "寅福うどん",
            "伊勢海老亭",
            "海幸丼太郎",
            "築地市場寿司",
            "風月堂ラーメン",
            "紅葉亭",
            "金のとんかつ",
            "笹塚うどん",
            "山の神蕎麦",
            "花鳥風月寿司",
            "お好み焼き風雲児",
            "桜吹雪ラーメン",
            "大漁丼",
            "月見うどん",
            "鮨乃竹",
            "焼き鳥一番",
            "三ツ星カレー",
            "海鮮炉端かば"
        ];

        $openingTimes = [
            '10:00:00',
            '11:00:00',
            '12:00:00',
            '17:00:00',
            '18:00:00',
            '19:00:00',
        ];

        $closingTimes = [
            '21:00:00',
            '22:00:00',
            '23:00:00',
            '24:00:00',
        ];

        for ($i = 0; $i < 50; $i++) {
            $randomOpeningTime = $faker->randomElement($openingTimes);
            $randomClosingTime = $faker->randomElement($closingTimes);

            Restaurant::create([
                'name'=> $names[$i],
                'image' => 'noimage.jpg',
                'postal_code' => $postalCodes[$i],
                'address' => '愛知県名古屋市' . $addresses[$i],
                'description' => $faker->paragraph,
                'opening_time' => $randomOpeningTime,
                'closing_time' => $randomClosingTime
            ]);
        }
    }
}
