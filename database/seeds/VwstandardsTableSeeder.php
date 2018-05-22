<?php

use Illuminate\Database\Seeder;

class VwstandardsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file/
     *
     * @return void
     */
    public function run()
    {


        \DB::table('vwstandards')->delete();

        \DB::table('vwstandards')->insert(array (
            0 =>
            array (
                'wdt_ID' => 1,
                'id' => 3,
                'sortsequence' => 33,
                'stdname' => 'ASTM D4236',
                'stddesc' => 'Labeling of Art Materials',
            ),
            1 =>
            array (
                'wdt_ID' => 2,
                'id' => 8,
                'sortsequence' => 41,
                'stdname' => 'FCC 47 CFR15:2007 - Radiation Interference',
                'stddesc' => 'Radiation Interference',
            ),
            2 =>
            array (
                'wdt_ID' => 3,
                'id' => 12,
                'sortsequence' => 9,
                'stdname' => 'CPSIA Section 101',
                'stddesc' => 'Total Lead content',
            ),
            3 =>
            array (
                'wdt_ID' => 4,
                'id' => 14,
                'sortsequence' => 10,
                'stdname' => 'CPSIA Section 108',
                'stddesc' => 'Phthalates',
            ),
            4 =>
            array (
                'wdt_ID' => 5,
                'id' => 15,
                'sortsequence' => 21,
            'stdname' => '16 CFR 1500.3(b)(5)-(9)&(c)(1)-(5) - TRA',
                'stddesc' => 'TRA - Toxicology & Hazardous Substances.',
            ),
            5 =>
            array (
                'wdt_ID' => 6,
                'id' => 16,
                'sortsequence' => 22,
            'stdname' => '16 CFR 1500.14(b)(8) - Art Materials',
                'stddesc' => 'Art Materials.',
            ),
            6 =>
            array (
                'wdt_ID' => 7,
                'id' => 21,
                'sortsequence' => 27,
                'stdname' => '16 CFR 1500.19',
            'stddesc' => 'CSPA Labeling (small parts, etc.)',
            ),
            7 =>
            array (
                'wdt_ID' => 8,
                'id' => 22,
                'sortsequence' => 6,
                'stdname' => '16 CFR 1500.44',
                'stddesc' => 'Flammability',
            ),
            8 =>
            array (
                'wdt_ID' => 9,
                'id' => 23,
                'sortsequence' => 7,
                'stdname' => '16 CFR 1500.48 & 49 - Sharp Points/Edges',
                'stddesc' => 'Sharp points/Edges',
            ),
            9 =>
            array (
                'wdt_ID' => 10,
                'id' => 24,
                'sortsequence' => 8,
                'stdname' => '16 CFR Part 1501 - Small Parts',
                'stddesc' => 'Small Parts',
            ),
            10 =>
            array (
                'wdt_ID' => 11,
                'id' => 25,
                'sortsequence' => 28,
                'stdname' => '16 CFR Part 1505 - Elec. Operated Toys',
                'stddesc' => 'Electrically Operated Toys & Childrens Articles',
            ),
            11 =>
            array (
                'wdt_ID' => 12,
                'id' => 29,
                'sortsequence' => 32,
                'stdname' => '16 CFR Part 1611',
                'stddesc' => 'Flammability of Vinyl Plastic Film',
            ),
            12 =>
            array (
                'wdt_ID' => 13,
                'id' => 31,
                'sortsequence' => 35,
                'stdname' => 'CA Proposition 65',
                'stddesc' => 'lead & Phthalate limitations',
            ),
            13 =>
            array (
                'wdt_ID' => 14,
                'id' => 33,
                'sortsequence' => 43,
                'stdname' => 'WA',
                'stddesc' => 'Cadmium or Phthalates in certain children\'s products',
            ),
            14 =>
            array (
                'wdt_ID' => 15,
                'id' => 36,
                'sortsequence' => 5,
            'stdname' => '16 CFR 1500.3(c) (6)(vi)',
                'stddesc' => 'Flammability Test on Rigid and Pliable Solids',
            ),
            15 =>
            array (
                'wdt_ID' => 16,
                'id' => 37,
                'sortsequence' => 18,
                'stdname' => 'Canadian Toy Safety Mechanical',
                'stddesc' => 'Regulations for Mechanical and Physical Tests',
            ),
            16 =>
            array (
                'wdt_ID' => 17,
                'id' => 38,
                'sortsequence' => 19,
                'stdname' => 'Canadian Toy Safety Noise Level',
            'stddesc' => 'Hazardous Product Act Schedule I Part I Clause 10(a) for Noise Level Requirement',
            ),
            17 =>
            array (
                'wdt_ID' => 18,
                'id' => 39,
                'sortsequence' => 17,
                'stdname' => 'Canadian Toy Safety Hazardous Products',
                'stddesc' => 'Hazardous Product Act Schedule I Part I Item 7',
            ),
            18 =>
            array (
                'wdt_ID' => 19,
                'id' => 40,
                'sortsequence' => 16,
                'stdname' => 'Canadian Toy Safety Flammability',
            'stddesc' => 'Hazardous Products (Toys) Regulations Section (16) (17) for Flammability Test',
            ),
            19 =>
            array (
                'wdt_ID' => 20,
                'id' => 41,
                'sortsequence' => 20,
                'stdname' => 'Canadian Toy Safety Toxic Elements',
            'stddesc' => 'Hazardous Products Act (Rev 1997) Schedule I Part I Item 9 with Amendment 4/19/2005 for Toxic Elements Test',
            ),
            20 =>
            array (
                'wdt_ID' => 21,
                'id' => 50,
                'sortsequence' => 4,
                'stdname' => '16 CFR 1303 - Lead in Surface Coating',
                'stddesc' => 'CPSIA 101 - Lead in Paint & Surface Coatings',
            ),
            21 =>
            array (
                'wdt_ID' => 22,
                'id' => 64,
                'sortsequence' => 48,
                'stdname' => 'HR2024 HVY METAL IN BATTERIES',
                'stddesc' => 'HVY METAL BATTERIES ACCORDING TO THE LAW 104-142',
            ),
            22 =>
            array (
                'wdt_ID' => 23,
                'id' => 71,
                'sortsequence' => 68,
                'stdname' => 'ASTM F963-16 4.3.7 Stuffing Cleanliness',
                'stddesc' => 'ASTM F963 4.3.7 Stuffing Cleanliness',
            ),
            23 =>
            array (
                'wdt_ID' => 24,
                'id' => 72,
                'sortsequence' => 51,
                'stdname' => 'PA - Title 34, Chptr 47 Sec 47,317',
                'stddesc' => 'Comwlth of PA Reg for Stuffed Toys',
            ),
            24 =>
            array (
                'wdt_ID' => 25,
                'id' => 73,
                'sortsequence' => 52,
                'stdname' => 'Canadian Cosmetic Regulations',
                'stddesc' => 'Canadian Cosmetic Regulations',
            ),
            25 =>
            array (
                'wdt_ID' => 26,
                'id' => 74,
                'sortsequence' => 53,
            'stdname' => 'Canadian - Phthalates (SOR/2010-298)',
            'stddesc' => 'CCPSA - (SOR/2010-298)',
            ),
            26 =>
            array (
                'wdt_ID' => 27,
                'id' => 75,
                'sortsequence' => 54,
                'stdname' => 'Canadian SOR/2011-17 Heavy Metals',
                'stddesc' => 'Canada SOR/2011-17 Heavy Metals',
            ),
            27 =>
            array (
                'wdt_ID' => 28,
                'id' => 76,
                'sortsequence' => 55,
                'stdname' => 'Canadian Lead Risk Reduction Strategy',
                'stddesc' => 'Canada Lead Risk Reduction ',
            ),
            28 =>
            array (
                'wdt_ID' => 29,
                'id' => 79,
                'sortsequence' => 58,
                'stdname' => 'US FDA 21 CFR 700.13 Mercury content/ASTM',
                'stddesc' => 'Mercury Content',
            ),
            29 =>
            array (
                'wdt_ID' => 30,
                'id' => 80,
                'sortsequence' => 59,
                'stdname' => 'ASTM D-4236 - LHAMA - Art Materials',
                'stddesc' => 'LHAMA - Labeling Hazardous Art Materials',
            ),
            30 =>
            array (
                'wdt_ID' => 31,
                'id' => 86,
                'sortsequence' => 60,
                'stdname' => 'ASTM F963-16 Elements Migration in Substrate',
            'stddesc' => 'ASTM F963-16 4.3.5.2(2)(b) Elements Migration in Substrate',
            ),
            31 =>
            array (
                'wdt_ID' => 32,
                'id' => 87,
                'sortsequence' => 61,
                'stdname' => 'ASTM F963-16 Total Lead in Substrate',
                'stddesc' => 'ASTM F963-16 Total Lead in Substrate',
            ),
            32 =>
            array (
                'wdt_ID' => 33,
                'id' => 92,
                'sortsequence' => 63,
                'stdname' => 'ASTM F963-16 Elements Migration in Surface Coating',
                'stddesc' => 'ASTM F963-16 Migration in Surface Coating',
            ),
            33 =>
            array (
                'wdt_ID' => 34,
                'id' => 93,
                'sortsequence' => 64,
                'stdname' => 'ASTM F963-16 Total Lead in Surface Coating',
                'stddesc' => 'ASTM F963-16 Total Lead in Surface Coating',
            ),
            34 =>
            array (
                'wdt_ID' => 35,
                'id' => 95,
                'sortsequence' => 71,
                'stdname' => 'ASTM-16 Heavy elements test',
                'stddesc' => 'ASTM-16 Heavy elements test',
            ),
            35 =>
            array (
                'wdt_ID' => 36,
                'id' => 96,
                'sortsequence' => 66,
                'stdname' => 'ASTM F963-16 Cadmium in metallic small part',
            'stddesc' => 'ASTM F963-16 4.3.2(2)(C) Soluable Cadmium in metallic small part',
            ),
            36 =>
            array (
                'wdt_ID' => 37,
                'id' => 98,
                'sortsequence' => 69,
                'stdname' => 'Canada-Flammability Test: Dolls, Plush & Soft Toys',
            'stddesc' => 'Canada-Flammability Test:Dolls, Plush & Soft Toys(SOR/2011-17 Sec. 32-34)',
            ),
            37 =>
            array (
                'wdt_ID' => 38,
                'id' => 99,
                'sortsequence' => 70,
                'stdname' => 'Illinois Lead Act 410 ILCS 45',
                'stddesc' => 'Illinois Lead Poisoning Prevention Act 410 ILC 45',
            ),
            38 =>
            array (
                'wdt_ID' => 39,
                'id' => 101,
                'sortsequence' => 62,
                'stdname' => 'ASTM F963-16/ 16 CFR 1500 Physical & Mechanical',
                'stddesc' => 'ASTM F963-16/ 16 CFR 1500 Physical & Mechanical',
            ),
            39 =>
            array (
                'wdt_ID' => 40,
                'id' => 107,
                'sortsequence' => 67,
            'stdname' => 'ASTM F963-16/ 16 CFR 1500.3(c)(6)(vi) Flammability',
            'stddesc' => 'ASTM F963-16/ 16 CFR 1500.3 (c) (6) (vi) Flammability',
            ),
            40 =>
            array (
                'wdt_ID' => 41,
                'id' => 108,
                'sortsequence' => 56,
                'stdname' => 'Canadian SOR/2011-17 Physical & Mechanical',
                'stddesc' => 'Canadian SOR/2011-17 Physical & Mechanical',
            ),
            41 =>
            array (
                'wdt_ID' => 42,
                'id' => 109,
                'sortsequence' => 57,
                'stdname' => 'Canadian SOR/2011-17 Flammability',
                'stddesc' => 'Canadian SOR/2011-17 Flammability',
            ),
            42 =>
            array (
                'wdt_ID' => 43,
                'id' => 111,
                'sortsequence' => 74,
                'stdname' => 'Canadian Consumer Packaging Labeling Act',
                'stddesc' => 'Canadian Consumer Packaging Labeling Act',
            ),
            43 =>
            array (
                'wdt_ID' => 44,
                'id' => 112,
                'sortsequence' => 75,
                'stdname' => 'CPSIA 103 - Tracking label for Children',
                'stddesc' => 'CPSIA tracking labels for children\'s products',
            ),
            44 =>
            array (
                'wdt_ID' => 45,
                'id' => 115,
                'sortsequence' => 77,
                'stdname' => 'Canada Lead & Cadmium',
                'stddesc' => 'Canada Lead & Cadmium',
            ),
            45 =>
            array (
                'wdt_ID' => 46,
                'id' => 116,
                'sortsequence' => 78,
                'stdname' => 'ASTM 11 Clause 8.5.1 Wash Test',
                'stddesc' => 'Wash Test',
            ),
            46 =>
            array (
                'wdt_ID' => 47,
                'id' => 117,
                'sortsequence' => 79,
                'stdname' => 'Canadian Total Lead SOR/2010-273',
                'stddesc' => 'Total Lead in Substrate',
            ),
            47 =>
            array (
                'wdt_ID' => 48,
                'id' => 118,
                'sortsequence' => 80,
            'stdname' => 'Canada Consumer Product Safety Act  (SOR/2011-17)',
                'stddesc' => 'Canada Consumer Product Safety Act',
            ),
            48 =>
            array (
                'wdt_ID' => 49,
                'id' => 119,
                'sortsequence' => 81,
            'stdname' => 'California Health and Safety - Phthalates (AB1108)',
            'stddesc' => 'California Health and Safety - Phthalates (AB1108)',
            ),
            49 =>
            array (
                'wdt_ID' => 50,
                'id' => 124,
                'sortsequence' => 83,
                'stdname' => 'Canada Sec. 21 Celluloid or Cellulose Nitrate',
                'stddesc' => '',
            ),
            50 =>
            array (
                'wdt_ID' => 51,
                'id' => 125,
                'sortsequence' => 83,
                'stdname' => 'Canada, Sec. 23 Toxic Elements Test',
                'stddesc' => '',
            ),
            51 =>
            array (
                'wdt_ID' => 52,
                'id' => 126,
                'sortsequence' => 84,
                'stdname' => 'Canada Hazardous Chemicals',
                'stddesc' => '',
            ),
            52 =>
            array (
                'wdt_ID' => 53,
                'id' => 129,
                'sortsequence' => 86,
                'stdname' => 'Canada Lead & Mercury',
                'stddesc' => '',
            ),
            53 =>
            array (
                'wdt_ID' => 54,
                'id' => 133,
                'sortsequence' => 131,
                'stdname' => 'European Phthalates 1907/2006',
            'stddesc' => 'European Regulation (EC) No. 1907/2006 (REACH) Annex XVII and its amendments - Phthalate content',
            ),
            54 =>
            array (
                'wdt_ID' => 55,
                'id' => 134,
                'sortsequence' => 132,
                'stdname' => 'Canada Standard ICES-003',
                'stddesc' => 'Canada Standard ICES-003, Issue 5',
            ),
            55 =>
            array (
                'wdt_ID' => 56,
                'id' => 137,
                'sortsequence' => 132,
                'stdname' => 'TPCH - Total, Lead, Cad., Merc., Hex. Chrom',
            'stddesc' => 'TPCH: (Toxics in Packaging Clearing House) Total Lead, Cadmium, Mercury and Hexavalent Chromium',
            ),
            56 =>
            array (
                'wdt_ID' => 57,
                'id' => 138,
                'sortsequence' => 138,
                'stdname' => 'ASTM F2923-11 - Specs. for Children\'s Jewelry',
                'stddesc' => 'ASTM F2923-11 - Specs. for Children\'s Jewelry',
            ),
            57 =>
            array (
                'wdt_ID' => 58,
                'id' => 139,
                'sortsequence' => 139,
                'stdname' => 'ASTM F2923-11 - Clause 5, Lead',
                'stddesc' => 'Specifications for Children\'s Jewelry, Clause 5 - Lead',
            ),
            58 =>
            array (
                'wdt_ID' => 59,
                'id' => 143,
                'sortsequence' => 140,
                'stdname' => 'ASTM F2923-11 - Clause 8, Soluble Elements',
                'stddesc' => 'ASTM F2923-11 - Clause 8, Soluble Elements in Paint and Surface Coating',
            ),
            59 =>
            array (
                'wdt_ID' => 60,
                'id' => 148,
                'sortsequence' => 148,
            'stdname' => '16 CFR 1500.83(a)(23) Chemisty Set Labeling',
            'stddesc' => '16 CFR 1500.83(a)(23) Chemisty Set Labeling',
            ),
            60 =>
            array (
                'wdt_ID' => 61,
                'id' => 149,
                'sortsequence' => 149,
                'stdname' => 'Microbial Limit USP 61 & USP 62',
                'stddesc' => 'Microbial Limit USP 61 & USP 62',
            ),
            61 =>
            array (
                'wdt_ID' => 62,
                'id' => 150,
                'sortsequence' => 150,
                'stdname' => '21 CFR 701/740 - Cosmetic Labeling Requirements',
                'stddesc' => '21 CFR 701/740 - Cosmetic Labeling Requirements',
            ),
            62 =>
            array (
                'wdt_ID' => 63,
                'id' => 156,
                'sortsequence' => 151,
                'stdname' => 'US Law 104-142 - Mercury Battery Mngmt',
            'stddesc' => 'US Public Law 104-142 (1996) Title II - Mercury Containing Battery Management Act',
            ),
            63 =>
            array (
                'wdt_ID' => 64,
                'id' => 157,
                'sortsequence' => 152,
                'stdname' => 'USP 38-NF33, 2015, CHAPTER 51',
                'stddesc' => 'ANTIMICROBIAL EFFECTIVENESS TESTING',
            ),
            64 =>
            array (
                'wdt_ID' => 65,
                'id' => 158,
                'sortsequence' => 152,
                'stdname' => 'Antimicrobial USP 38-NF33, 2015, CH',
                'stddesc' => '',
            ),
            65 =>
            array (
                'wdt_ID' => 66,
                'id' => 159,
                'sortsequence' => 159,
                'stdname' => 'TDCP Content',
                'stddesc' => 'TDCP Content',
            ),
            66 =>
            array (
                'wdt_ID' => 67,
                'id' => 160,
                'sortsequence' => 160,
                'stdname' => 'US 16 CFR Part 1307 Phthalates',
                'stddesc' => '2017 New Phthalate Standards',
            ),
            67 =>
            array (
                'wdt_ID' => 68,
                'id' => 161,
                'sortsequence' => 161,
                'stdname' => 'ASTM-17 - Gap Testing',
                'stddesc' => 'Gap Testing between ASTM-16 and new ASTM-17 Standards',
            ),
            68 =>
            array (
                'wdt_ID' => 69,
                'id' => 162,
                'sortsequence' => 162,
                'stdname' => 'ASTM F963-11 Total Lead in Substrate',
                'stddesc' => 'ASTM F963-11 Total Lead in Substrate',
            ),
            69 =>
            array (
                'wdt_ID' => 70,
                'id' => 163,
                'sortsequence' => 163,
                'stdname' => 'ASTM F963-11 Total Lead in Surface Coating',
                'stddesc' => 'ASTM F963-11 Total Lead in Surface Coating',
            ),
            70 =>
            array (
                'wdt_ID' => 71,
                'id' => 164,
                'sortsequence' => 164,
                'stdname' => '	ASTM F963-11/ 16 CFR 1500 Physical & Mechanical',
                'stddesc' => 'ASTM F963-11/ 16 CFR 1500 Physical & Mechanical',
            ),
            71 =>
            array (
                'wdt_ID' => 72,
                'id' => 165,
                'sortsequence' => 165,
            'stdname' => 'ASTM F963-11/ 16 CFR 1500.3(c)(6)(vi) Flammability',
            'stddesc' => 'ASTM F963-11/ 16 CFR 1500.3 (c) (6) (vi) Flammability',
            ),
            72 =>
            array (
                'wdt_ID' => 73,
                'id' => 167,
                'sortsequence' => 167,
                'stdname' => 'ASTM-11 Heavy elements test',
                'stddesc' => 'ASTM-11 Heavy elements test',
            ),
            73 =>
            array (
                'wdt_ID' => 74,
                'id' => 168,
                'sortsequence' => 168,
                'stdname' => 'ASTM F963-17 Total Lead in Substrate',
                'stddesc' => 'ASTM F963-16 Total Lead in Substrate',
            ),
            74 =>
            array (
                'wdt_ID' => 75,
                'id' => 169,
                'sortsequence' => 169,
                'stdname' => '	ASTM F963-17 Total Lead in Surface Coating',
                'stddesc' => 'ASTM F963-17 Total Lead in Surface Coating',
            ),
            75 =>
            array (
                'wdt_ID' => 76,
                'id' => 170,
                'sortsequence' => 170,
                'stdname' => '	ASTM-17 Heavy elements test',
                'stddesc' => 'ASTM-17 Heavy elements test',
            ),
            76 =>
            array (
                'wdt_ID' => 77,
                'id' => 171,
                'sortsequence' => 171,
                'stdname' => 'ASTM F963-17/ 16 CFR 1500 Physical & Mechanical',
                'stddesc' => 'ASTM F963-17/ 16 CFR 1500 Physical & Mechanical',
            ),
            77 =>
            array (
                'wdt_ID' => 78,
                'id' => 180,
                'sortsequence' => 172,
                'stdname' => '	ASTM F963-17/Flammability',
            'stddesc' => '	ASTM F963-17/ 16 CFR 1500.3 (c) (6) (vi) Flammability',
            ),
        ));


    }
}