
--
-- Table structure for table `account`
--


/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `id_account` int(7) NOT NULL AUTO_INCREMENT,
  `nama_account` varchar(50) NOT NULL,
  `id_jenis_account` varchar(50) NOT NULL,
  `english` varchar(100) NOT NULL,
  PRIMARY KEY (`id_account`),
  KEY `jenis_account` (`id_jenis_account`),
  KEY `jenis_account_2` (`id_jenis_account`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,'Kas','1','Cash and Cash Equivalents'),(2,'Bank','1','Bank'),(3,'Piutang Dagang','1','Account Receivable'),(4,'Biaya Dibayar Dimuka','1','Prepaid Expense'),(5,'Ppn Masukan','1','Income Ppn'),(6,'Persediaan','1','Stock'),(7,'Piutang Karyawan','1','Employee Receivables'),(8,'Tanah','2','Land'),(9,'Gedung','2','Building'),(10,'Akumulasi Depresiasi Gedung','2','Accumulated Depreciation of Building'),(11,'Mesin-mesin','2','Machines'),(12,'Akumulasi Depresiasi Mesin-mesin','2','Accumulated Depreciation of Machines'),(13,'Inventaris','2','Inventory'),(14,'Akumulasi Depresiasi Inventaris','2','Accumulated Depreciation of Inventory'),(15,'Kendaraan','2','Vehicles'),(16,'Akumulasi Depresiasi Kendaraan','2','Accumulated Depreciation of Vehicles'),(17,'Hutang Biaya','3','Expense Payable'),(18,'Hutang Biaya Bandwith','3','Bandwith Expense Payable'),(19,'Hutang Gaji','3','Salary Payable'),(20,'Hutang Connectsi','3','Connectsi Payable'),(21,'Hutang Dagang','3','Sales Payable'),(22,'Hutang Ppn','3','Ppn Payable'),(23,'Pendapatan Dimuka','8','Other Payable'),(24,'Hutang Internal','3','Intern Payable'),(25,'Hutang Hardware','3','Hardware Payable'),(26,'Hutang Biaya Bunga','3','Interest Rate Payable'),(27,'Hutang Fee','3','Fee Payable'),(28,'Hutang Office','3','Office Payable'),(29,'Hutang Bank','4','Bank Payable'),(30,'Modal','5','Capital'),(31,'Laba (Rugi) Tahun Berjalan','8','Net Income'),(32,'Registrasi','6','Register'),(33,'Pendapatan Dial Up','6','Dial Up Revenues'),(34,'Pendapatan Internet','6','Internet Revenues'),(35,'Pendapatan Web & Domain','6','Web & Domain Revenues'),(36,'Pendapatan Lain-lain','6','Others Revenues'),(37,'Pendapatan Hardware','6','Hardware Revenues'),(38,'Pendapatan Bank','7','Bank Revenues'),(39,'Biaya Bank','8','Bank Charges'),(40,'Biaya Bandwith','8','Bandwith Cost'),(41,'Biaya Lain-lain','8','Others Cost'),(42,'Biaya Overhead','8','Overhead Cost'),(43,'Potongan Penjualan','8','Sales Discounts'),(44,'Biaya Bunga Hutang','3','Interest Rate of Debt'),(45,'Biaya Web & Domain','8','Web & Domain Cost'),(46,'PPh ps 23','8','PPh ps 23'),(47,'PPN','8','PPN'),(48,'Biaya Hak Penggunaan & USO','8','Usage Rights & USO Charges'),(49,'Biaya Penyusutan Gedung','8','Depreciation Cost Building'),(50,'Biaya Maintenance','8','Maintenance Cost'),(51,'Biaya Penyusutan Mesin-mesin','8','Depreciation Cost of Machines'),(52,'Biaya Penyusutan Inventaris','8','Depreciation Cost of Inventory'),(53,'Biaya Penyusutan Sewa BTS','8','Depreciation Cost of BTS Rent'),(54,'Biaya Operasional Kantor','8','Office Operational Cost'),(55,'Biaya Rumah Tangga Kantor','8','Household Office Cost'),(56,'Fee Marketing','8',''),(57,'Biaya Sewa','8',''),(58,'Biaya Penjualan','8',''),(59,'Cadangan THR','8',''),(60,'Biaya Utilities','8','Utilities Cost'),(61,'Biaya Telepon','8','Telephone Cost'),(62,'Salary','8','Salary'),(63,'Biaya Office Supplies','8','Office Supplies Cost'),(64,'Biaya Travel','8','Travel Cost'),(65,'Biaya Marketing','8','Marketing Cost'),(66,'Biaya Asuransi','8','Insurance Cost');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;

--
-- Table structure for table `data_temp`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_temp` (
  `id_temp` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `nominal` int(11) NOT NULL,
  `id_account` varchar(225) NOT NULL,
  `in_out` enum('i','o') NOT NULL,
  `status` enum('belum','sudah') NOT NULL,
  `ekstra` varchar(225) NOT NULL,
  PRIMARY KEY (`id_temp`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_temp`
--


--
-- Table structure for table `data_transaksi`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(225) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `nominal` int(11) NOT NULL,
  `id_account` text NOT NULL,
  `DK` enum('D','K') NOT NULL,
  `id_temp` varchar(225) NOT NULL,
  `ekstra` text NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_transaksi`
--



--
-- Table structure for table `jenis_account`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jenis_account` (
  `id_jenis_account` int(3) NOT NULL AUTO_INCREMENT,
  `jenis_account` varchar(50) NOT NULL,
  `id_master_jenis_account` varchar(225) NOT NULL,
  PRIMARY KEY (`id_jenis_account`),
  KEY `jenis_account` (`jenis_account`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis_account`
--

/*!40000 ALTER TABLE `jenis_account` DISABLE KEYS */;
INSERT INTO `jenis_account` VALUES (1,'ASET LANCAR','1'),(2,'ASET TETAP','1'),(3,'KEWAJIBAN LANCAR','2'),(4,'KEWAJIBAN JANGKA PANJANG','2'),(5,'EKUITAS','3'),(6,'PENDAPATAN USAHA','4'),(7,'PENDAPATAN LAIN LAIN','4'),(8,'BIAYA','5');
/*!40000 ALTER TABLE `jenis_account` ENABLE KEYS */;

--
-- Table structure for table `master_jenis_account`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_jenis_account` (
  `id_master_jenis_account` int(11) NOT NULL AUTO_INCREMENT,
  `master_jenis_account` varchar(225) NOT NULL,
  PRIMARY KEY (`id_master_jenis_account`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_jenis_account`
--

/*!40000 ALTER TABLE `master_jenis_account` DISABLE KEYS */;
INSERT INTO `master_jenis_account` VALUES (1,'ASSET'),(2,'KEWAJIBAN'),(3,'EKUITAS'),(4,'PENDAPATAN'),(5,'BIAYA');
/*!40000 ALTER TABLE `master_jenis_account` ENABLE KEYS */;


