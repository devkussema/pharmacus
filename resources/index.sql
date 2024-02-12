-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para pharmacus
CREATE DATABASE IF NOT EXISTS `pharmacus` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pharmacus`;

-- Copiando estrutura para tabela pharmacus.areas_hospitalares
CREATE TABLE IF NOT EXISTS `areas_hospitalares` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `areas_hospitalares_nome_unique` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.areas_hospitalares: ~6 rows (aproximadamente)
INSERT INTO `areas_hospitalares` (`id`, `nome`, `descricao`, `created_at`, `updated_at`) VALUES
	(1, 'Hemoterapia', 'Esta área geralmente lida com transfusões de sangue e procedimentos relacionados. Possíveis campos adicionais podem incluir capacidade de armazenamento de sangue, equipamentos especializados (por exemplo, refrigeradores para armazenamento de sangue), horários de funcionamento e protocolos de segurança para manuseio de sangue.', '2024-02-10 12:57:16', '2024-02-10 12:57:16'),
	(2, 'Armazém II', 'sta área provavelmente se refere a um armazém de suprimentos médicos e equipamentos.', '2024-02-10 12:58:51', '2024-02-10 12:58:51'),
	(4, 'Berçário', 'Esta área é geralmente dedicada ao cuidado de recém-nascidos. Campos adicionais podem incluir capacidade do berçário, equipamentos especializados (por exemplo, incubadoras, fototerapia), procedimentos de cuidados neonatais, políticas de segurança infantil e treinamento da equipe.', '2024-02-10 13:00:07', '2024-02-10 13:00:07'),
	(5, 'Estomatologia', 'Eis uma área para cuidar do estômago.', '2024-02-04 13:00:32', '2024-02-11 11:03:28'),
	(6, 'Bloco Operatório', 'Esta área é usada para cirurgias. Campos adicionais podem incluir salas de cirurgia disponíveis, horários de funcionamento, equipe cirúrgica (por exemplo, cirurgiões, enfermeiros de cirurgia), equipamentos cirúrgicos especializados e protocolos de esterilização.', '2024-02-10 13:00:51', '2024-02-10 13:00:51'),
	(7, 'Maternidade Internamento', NULL, '2024-02-10 13:01:24', '2024-02-10 13:01:24');

-- Copiando estrutura para tabela pharmacus.cargos
CREATE TABLE IF NOT EXISTS `cargos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cargos_nome_unique` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.cargos: ~1 rows (aproximadamente)
INSERT INTO `cargos` (`id`, `nome`, `descricao`, `created_at`, `updated_at`) VALUES
	(1, 'Diretor Médico', 'Diretor Médico é responsável por supervisionar todas as operações clínicas e médicas da instituição.', '2024-02-12 17:13:34', '2024-02-12 17:13:34'),
	(2, 'Diretor Administrativo', 'É responsável pela gestão financeira, administrativa e operacional da área hospitalar.', '2024-02-12 17:14:55', '2024-02-12 17:14:55'),
	(3, 'Diretor de Enfermagem', 'O Diretor de Enfermagem é encarregado de supervisionar todas as atividades relacionadas à enfermagem na área hospitalar, incluindo a gestão de pessoal de enfermagem e a manutenção dos padrões de cuidados.', '2024-02-12 17:15:20', '2024-02-12 17:15:20'),
	(4, 'Gerente de Unidade', 'Em unidades específicas dentro do hospital, como unidades de terapia intensiva, de emergência ou de cirurgia, pode haver gerentes de unidade responsáveis pela administração e operação dessas áreas.', '2024-02-12 17:15:42', '2024-02-12 17:15:42'),
	(5, 'Coordenador de Serviços Hospitalares', 'Este papel envolve a coordenação e supervisão de uma variedade de serviços hospitalares, incluindo serviços de apoio, manutenção, alimentação, entre outros.', '2024-02-12 17:16:05', '2024-02-12 17:16:05');

-- Copiando estrutura para tabela pharmacus.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.categorias: ~15 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `nome`, `tipo`, `descricao`, `created_at`, `updated_at`) VALUES
	(1, 'Medicamentos de prescrição', 'produto', 'Produtos que requerem uma prescrição médica para serem adquiridos, geralmente para o tratamento de condições de saúde específicas.', '2024-02-07 13:58:32', '2024-02-07 13:58:32'),
	(2, 'Medicamentos de venda livre (OTC - Over-the-counter)', 'produto', 'Produtos que podem ser adquiridos sem a necessidade de uma prescrição médica, geralmente para o tratamento de condições menores como dor de cabeça, resfriados, alergias, etc.', '2024-02-07 13:58:32', '2024-02-07 13:58:32'),
	(3, 'Injetáveis', 'produto', 'Produtos farmacêuticos que são administrados por meio de injeção, como vacinas, insulina, e outros medicamentos injetáveis.', '2024-02-07 13:58:32', '2024-02-07 13:58:32'),
	(4, 'Aerosóis', 'produto', 'Produtos que são administrados por meio de aerossolização, como sprays nasais, sprays para a garganta, e inaladores para tratamento de asma.', '2024-02-07 13:58:32', '2024-02-07 13:58:32'),
	(5, 'Oral sólidos', 'produto', 'Produtos farmacêuticos que são administrados por via oral na forma de comprimidos, cápsulas, comprimidos mastigáveis, entre outros.', '2024-02-07 13:58:32', '2024-02-07 13:58:32'),
	(6, 'Tópicos', 'produto', 'Produtos que são aplicados na superfície da pele ou em uma membrana mucosa, como pomadas, cremes, loções, e géis.', '2024-02-07 13:58:32', '2024-02-07 13:58:32'),
	(7, 'Suplementos nutricionais', 'produto', 'Produtos que fornecem nutrientes adicionais ao corpo, como vitaminas, minerais, aminoácidos, e outros suplementos dietéticos.', '2024-02-07 13:58:32', '2024-02-07 13:58:32'),
	(8, 'Homeopáticos', 'produto', 'Produtos baseados na prática da homeopatia, que envolve a utilização de substâncias altamente diluídas para tratar diversas condições de saúde.', '2024-02-07 13:58:32', '2024-02-07 13:58:32'),
	(9, 'Fitoterápicos', 'produto', 'Produtos derivados de plantas medicinais, usados para prevenir, aliviar ou tratar várias condições de saúde.', '2024-02-07 13:58:32', '2024-02-07 13:58:32'),
	(10, 'Cosméticos', 'produto', 'Produtos utilizados para melhorar a aparência física, como cremes hidratantes, protetores solares, maquiagens, entre outros.', '2024-02-07 13:58:32', '2024-02-07 13:58:32'),
	(11, 'Farmácias Hospitalares', 'farmacia', 'Aquelas que estão localizadas dentro de hospitais e atendem principalmente aos pacientes internados, fornecendo medicamentos prescritos durante a internação e após a alta hospitalar.', '2024-02-07 13:58:51', '2024-02-07 13:58:51'),
	(12, 'Farmácias Independentes', 'farmacia', 'São aquelas que operam de forma independente, não associadas a nenhum hospital ou grande rede. Elas podem ser de propriedade de um farmacêutico individual ou de uma pequena empresa.', '2024-02-07 13:58:51', '2024-02-07 13:58:51'),
	(13, 'Farmácias de Rede', 'farmacia', 'São farmácias que fazem parte de uma rede de estabelecimentos, como grandes cadeias de farmácias. Elas podem ter várias filiais em diferentes localidades e podem oferecer uma ampla variedade de produtos e serviços.', '2024-02-07 13:58:51', '2024-02-07 13:58:51'),
	(14, 'Farmácias de Bairro', 'farmacia', 'São farmácias localizadas em áreas residenciais, geralmente de pequeno porte e que atendem principalmente à comunidade local.', '2024-02-07 13:58:51', '2024-02-07 13:58:51'),
	(15, 'Farmácias de Atendimento Especializado', 'farmacia', 'São aquelas que se especializam em fornecer medicamentos e serviços específicos, como farmácias de manipulação, farmácias de oncologia, entre outras.', '2024-02-07 13:58:51', '2024-02-07 13:58:51');

-- Copiando estrutura para tabela pharmacus.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.failed_jobs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela pharmacus.farmacias
CREATE TABLE IF NOT EXISTS `farmacias` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria_id` bigint unsigned DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obs` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farmacias_categoria_id_foreign` (`categoria_id`),
  CONSTRAINT `farmacias_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.farmacias: ~7 rows (aproximadamente)
INSERT INTO `farmacias` (`id`, `nome`, `status`, `codigo`, `categoria_id`, `descricao`, `logo`, `endereco`, `obs`, `created_at`, `updated_at`) VALUES
	('0f57a617-5234-4671-b4e9-56f521a0fb85', 'Farmácia do Tio Boa', 0, NULL, 13, NULL, NULL, 'Cassequel', NULL, '2024-02-12 12:47:58', '2024-02-07 12:47:58'),
	('650d6913-75f1-4aa0-a7e9-0c81a67096de', 'HSP', 1, 'HSP', 12, NULL, 'logotipos/hJWb3ZhWeR7MfxGclVgZDapwtLKSDs7zArPH3BQt.png', 'Futungo de Belas', NULL, '2024-02-12 14:50:20', '2024-02-12 14:50:20'),
	('859da84a-0927-48f4-b475-8c3fa4dfdf6f', 'Pharma 2', 0, NULL, 11, NULL, NULL, 'Futungo de Belas', NULL, '2024-02-10 12:58:29', '2024-02-07 12:58:29'),
	('94e66be7-fbd1-4ab6-bdf1-cbcef6cf63ec', 'Farmácia central', 0, NULL, 11, NULL, NULL, 'Av. 21 de Janeiro', NULL, '2024-02-07 12:41:10', '2024-02-07 12:41:10'),
	('ea94e76e-7f61-426f-b59f-7e635544707a', 'Zoft', 0, 'ZOFT', 13, NULL, 'logotipos/ckcmJ1gZF9S8NEQyjFUGA5K0LNScTqgERfNjP9FF.jpg', 'Futungo de Belas', NULL, '2024-02-07 14:32:16', '2024-02-07 14:32:16'),
	('f40f7184-541b-4be1-b111-c1f0c3cc9eb0', 'Farmácia central 2', 0, NULL, 14, NULL, NULL, 'Av. 21 de Janeiro', NULL, '2024-02-07 12:45:54', '2024-02-07 12:45:54'),
	('f4a1f71b-2ebe-4e53-b9c3-a94d0e753531', 'Pharma 1', 0, NULL, 12, NULL, NULL, 'Futungo de Belas', NULL, '2024-02-07 12:49:16', '2024-02-07 12:49:16');

-- Copiando estrutura para tabela pharmacus.gerente_farmacias
CREATE TABLE IF NOT EXISTS `gerente_farmacias` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `farmacia_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contato` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gerente_farmacias_user_id_foreign` (`user_id`),
  KEY `gerente_farmacias_farmacia_id_foreign` (`farmacia_id`),
  CONSTRAINT `gerente_farmacias_farmacia_id_foreign` FOREIGN KEY (`farmacia_id`) REFERENCES `farmacias` (`id`) ON DELETE CASCADE,
  CONSTRAINT `gerente_farmacias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.gerente_farmacias: ~1 rows (aproximadamente)
INSERT INTO `gerente_farmacias` (`id`, `user_id`, `cargo`, `farmacia_id`, `contato`, `created_at`, `updated_at`) VALUES
	('7ae3c9b6-4d34-4ad4-a015-fb4c229f7e24', '53ac026d-97b6-4230-8aae-2601b1d22f84', 'Gerente', '650d6913-75f1-4aa0-a7e9-0c81a67096de', '934675098', '2024-02-12 15:30:09', '2024-02-12 15:30:09');

-- Copiando estrutura para tabela pharmacus.grupos
CREATE TABLE IF NOT EXISTS `grupos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.grupos: ~12 rows (aproximadamente)
INSERT INTO `grupos` (`id`, `nome`, `descricao`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', NULL, '2024-02-08 18:53:42', '2024-02-08 18:53:44'),
	(2, 'Moderador', NULL, '2024-02-08 18:53:56', '2024-02-08 18:53:54'),
	(3, 'Gerente', NULL, '2024-02-08 18:54:11', '2024-02-08 18:54:13'),
	(4, 'Editor', NULL, '2024-02-08 18:54:20', '2024-02-08 18:54:18'),
	(5, 'Administrador', 'Um usuário com permissões avançadas de gerenciamento do sistema, geralmente com acesso total a todas as funcionalidades e recursos.', '2024-02-08 18:05:47', '2024-02-08 18:05:47'),
	(6, 'Moderador', 'Um usuário com poderes intermediários, responsável por revisar e moderar conteúdo gerado pelos usuários, como postagens em fóruns, comentários, etc.', '2024-02-08 18:05:47', '2024-02-08 18:05:47'),
	(7, 'Membro Premium', 'Um usuário que optou por pagar uma taxa ou assinatura para acessar recursos adicionais ou conteúdo exclusivo do sistema.', '2024-02-08 18:05:47', '2024-02-08 18:05:47'),
	(8, 'Usuário Verificado', 'Um usuário que passou por um processo de verificação de identidade, garantindo uma maior confiabilidade em seu perfil e atividades no sistema.', '2024-02-08 18:05:47', '2024-02-08 18:05:47'),
	(9, 'Convidado', 'Um usuário que não se registrou no sistema, mas pode ter acesso limitado a determinadas funcionalidades, como visualização de conteúdo público.', '2024-02-08 18:05:47', '2024-02-08 18:05:47'),
	(10, 'Assinante', 'Um usuário que se inscreveu para receber atualizações ou notificações regulares do sistema, como newsletters ou boletins informativos.', '2024-02-08 18:05:47', '2024-02-08 18:05:47'),
	(11, 'Funcionário', 'Um usuário associado a uma organização ou empresa, com permissões específicas relacionadas ao seu papel ou departamento dentro da empresa.', '2024-02-08 18:05:47', '2024-02-08 18:05:47'),
	(12, 'Usuário Anônimo', 'Um usuário que acessa o sistema sem se identificar, geralmente com acesso limitado a recursos básicos.', '2024-02-08 18:05:47', '2024-02-08 18:05:47');

-- Copiando estrutura para tabela pharmacus.grupo_permissoes
CREATE TABLE IF NOT EXISTS `grupo_permissoes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `grupo_id` bigint unsigned NOT NULL,
  `permissao_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grupo_permissoes_grupo_id_foreign` (`grupo_id`),
  KEY `grupo_permissoes_permissao_id_foreign` (`permissao_id`),
  CONSTRAINT `grupo_permissoes_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `grupo_permissoes_permissao_id_foreign` FOREIGN KEY (`permissao_id`) REFERENCES `permissoes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.grupo_permissoes: ~1 rows (aproximadamente)
INSERT INTO `grupo_permissoes` (`id`, `grupo_id`, `permissao_id`, `created_at`, `updated_at`) VALUES
	(1, 5, 1, '2024-02-08 20:10:06', '2024-02-08 20:10:07');

-- Copiando estrutura para tabela pharmacus.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.migrations: ~18 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_02_07_004316_create_sessions_table', 2),
	(6, '2024_02_07_130459_create_farmacias_table', 3),
	(8, '2024_02_07_131249_create_gerente_farmacias_table', 4),
	(9, '2024_02_07_141724_create_categorias_table', 5),
	(10, '2024_02_07_143849_add_descricao_in_categorias_table', 6),
	(11, '2024_02_07_151651_add_fields_to_farmacias_table', 7),
	(12, '2024_02_07_214031_alter_sessions_table', 8),
	(13, '2024_02_07_214400_add_status_to_users_table', 9),
	(14, '2024_02_08_160237_alterar_tipo_tokenable_id_na_personal_access_tokens', 10),
	(15, '2024_02_08_164828_create_users_tokens_table', 11),
	(16, '2024_02_08_184533_create_grupos_table', 12),
	(17, '2024_02_08_185102_create_permissaos_table', 13),
	(18, '2024_02_08_185924_add_descricao_in_grupos_table', 14),
	(19, '2024_02_08_193554_create_user_groups_table', 15),
	(20, '2024_02_08_195815_remove_grupo_id_from_permissoes', 16),
	(21, '2024_02_08_200233_create_grupo_permissaos_table', 17),
	(22, '2024_02_10_114745_create_nivel_acessos_table', 18),
	(23, '2024_02_10_131708_create_area_hospitalars_table', 19),
	(24, '2024_02_11_152846_add_status_to_farmacias_table', 20),
	(25, '2024_02_11_155842_add_foto_perfil_to_users_table', 20),
	(26, '2024_02_11_162026_add_grupo_id_to_users_table', 20),
	(27, '2024_02_11_162226_add_foreign_key_to_users_table', 20),
	(28, '2024_02_12_174911_create_cargos_table', 21);

-- Copiando estrutura para tabela pharmacus.nivel_acessos
CREATE TABLE IF NOT EXISTS `nivel_acessos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.nivel_acessos: ~4 rows (aproximadamente)
INSERT INTO `nivel_acessos` (`id`, `nome`, `created_at`, `updated_at`) VALUES
	(1, 'leitura', '2024-02-10 12:24:58', '2024-02-10 12:24:59'),
	(2, 'convidado', '2024-02-10 12:25:11', '2024-02-10 12:25:10'),
	(3, 'comum', '2024-02-10 12:25:27', '2024-02-10 12:25:28'),
	(4, 'gerente', '2024-02-10 12:25:32', '2024-02-10 12:25:30');

-- Copiando estrutura para tabela pharmacus.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.password_reset_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela pharmacus.permissoes
CREATE TABLE IF NOT EXISTS `permissoes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `conteudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.permissoes: ~3 rows (aproximadamente)
INSERT INTO `permissoes` (`id`, `conteudo`, `created_at`, `updated_at`) VALUES
	(1, 'can.add_farmacia', '2024-02-08 18:54:59', '2024-02-08 18:55:01'),
	(2, 'can.add_gerente', '2024-02-08 18:55:18', '2024-02-08 18:55:17'),
	(3, 'can.add_funcionario', '2024-02-08 19:53:46', '2024-02-08 19:53:47');

-- Copiando estrutura para tabela pharmacus.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.personal_access_tokens: ~1 rows (aproximadamente)
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
	(6, 'App\\Models\\User', '11662235-d1dd-4e0a-839c-98d177f4b541', 'Token de confirmação de conta de gerente da farmácia', '911beb25f640694bca77c26d4f3d5852cb4689619bcaeecca9f6c5db63cfedce', '["*"]', NULL, NULL, '2024-02-08 15:44:55', '2024-02-08 15:44:55');

-- Copiando estrutura para tabela pharmacus.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.sessions: ~1 rows (aproximadamente)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('Ja20Pjy2isDzpja8kZM03Id0cgV267DO30xMs08b', '554b3bbd-8c75-460c-aea7-0e8b20e51736', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiemlmNnVuazlEN1g5V2ZXYVJmOVUyUkNyMWpQaVMwMzNXTjZqaVYwSCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMDoiaHR0cHM6Ly9waGFybWFjdXMubWUiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozODoiaHR0cHM6Ly9waGFybWFjdXMubWUvYXBpL2NoZWNrLXNlc3Npb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czozNjoiNTU0YjNiYmQtOGM3NS00NjBjLWFlYTctMGU4YjIwZTUxNzM2Ijt9', 1707759145),
	('pL9jAVvmQzG8HzdEnvBGI9XiaSgzDpyqbzf3Fj6L', '53ac026d-97b6-4230-8aae-2601b1d22f84', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWkVaYkVYUmJiWERYWDJ6WTEzTkxVZE1ScGRKTFg2dThNNlhGWUxITiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vcGhhcm1hY3VzLm1lL2FwaS9jaGVjay1zZXNzaW9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO3M6MzY6IjUzYWMwMjZkLTk3YjYtNDIzMC04YWFlLTI2MDFiMWQyMmY4NCI7fQ==', 1707759128);

-- Copiando estrutura para tabela pharmacus.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grupo_id` bigint unsigned DEFAULT NULL,
  `foto_perfil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_grupo_id_foreign` (`grupo_id`),
  CONSTRAINT `users_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.users: ~7 rows (aproximadamente)
INSERT INTO `users` (`id`, `nome`, `status`, `username`, `email`, `grupo_id`, `foto_perfil`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	('1635e01a-5927-4330-96cd-babf6cffc2b8', 'Márcio', '0', 'márcio', 'marcio@email.co', 1, NULL, '2024-02-08 16:17:58', '$2y$12$cTwa6VkLSXm4cpv9oVegbOAOHOfWMbnz5xNqlCPu8m6l9MgsQ4kmC', NULL, '2024-02-08 15:56:42', '2024-02-11 18:48:49'),
	('1b6e7917-9753-406f-9029-24d0e34e585c', 'Chrome', '0', 'Chrome', 'chrome@email2.com', NULL, NULL, NULL, '$2y$12$hlg3X8r8Ee1PbeJZ25rkTeweYCZ7/e692jgXZyHlZkyNwdRVWPhBq', NULL, '2024-02-07 09:31:00', '2024-02-07 09:31:00'),
	('53ac026d-97b6-4230-8aae-2601b1d22f84', 'Adolfo Eduardo', '1', 'adolfo.eduardo', 'adolfo@email.ao', 3, NULL, '2024-02-12 15:35:21', '$2y$12$.nnD9FJeYADPGwuKH4AU8.2z/ic7f4P8WDcVcSVyBUPt9DO8IjUu.', NULL, '2024-02-12 15:30:08', '2024-02-12 15:35:21'),
	('554b3bbd-8c75-460c-aea7-0e8b20e51736', 'Farmaceutica Jobs', '1', 'Farmaceutica', 'farma@email.co', NULL, NULL, NULL, '$2y$12$lE6eEhiKxJ.9yYD30L1BTuaUXI55Lf7NJEhHqWF9e4N5wO7KYMtJO', NULL, '2024-02-07 09:32:01', '2024-02-07 09:32:01'),
	('ac2514b6-494c-465e-9e46-68b396bcadac', 'Augusto Kussema', '0', 'Augusto.Kussema', 'chrome@email.com', NULL, NULL, NULL, '$2y$12$qDF5snPAozYRkFqX1oPAP.rC0s9wwjPVlLoqBBDJwfjzzJKrIORiK', NULL, '2024-02-07 09:17:14', '2024-02-07 09:17:14'),
	('af1bcaab-d3cb-4c62-bdd5-a6cbb55c486d', 'Landrick', '0', 'landrick', 'edge@email.com', NULL, NULL, NULL, '$2y$12$2U2nl6.CxdKUQNk846i0suhVA85ocsmJu949m/ifQdWqA0kGp21uS', NULL, '2024-02-07 12:36:01', '2024-02-07 12:36:01'),
	('da5307d1-c05c-4366-a076-601d504fb623', 'Augusto Tiago', '0', 'Augusto.Tiago', 'tiago.a@email.com', NULL, NULL, NULL, '$2y$12$roYo9Azv0QVr34o7MGA5O.8j1hTErFY6ZALlIWq4gyLnvH.5pkp1a', NULL, '2024-02-07 09:27:04', '2024-02-07 09:27:04');

-- Copiando estrutura para tabela pharmacus.users_tokens
CREATE TABLE IF NOT EXISTS `users_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_tokens_user_id_foreign` (`user_id`),
  CONSTRAINT `users_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.users_tokens: ~0 rows (aproximadamente)
INSERT INTO `users_tokens` (`id`, `user_id`, `nome`, `token`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
	(1, '1635e01a-5927-4330-96cd-babf6cffc2b8', 'Confirmação de conta de gerente da farmácia', '981e5594-e9d0-4c76-b880-fd3ccf6db1c2', NULL, NULL, '2024-02-08 15:56:42', '2024-02-08 15:56:42'),
	(2, '53ac026d-97b6-4230-8aae-2601b1d22f84', 'Confirmação de conta de gerente da farmácia', '8b18a88c-c79c-47d7-adad-7c804510ebe0', '2024-02-12 15:35:21', NULL, '2024-02-12 15:30:09', '2024-02-12 15:35:21');

-- Copiando estrutura para tabela pharmacus.user_grupos
CREATE TABLE IF NOT EXISTS `user_grupos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grupo_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_grupos_user_id_foreign` (`user_id`),
  KEY `user_grupos_grupo_id_foreign` (`grupo_id`),
  CONSTRAINT `user_grupos_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_grupos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela pharmacus.user_grupos: ~1 rows (aproximadamente)
INSERT INTO `user_grupos` (`id`, `user_id`, `grupo_id`, `created_at`, `updated_at`) VALUES
	(1, '554b3bbd-8c75-460c-aea7-0e8b20e51736', 5, '2024-02-08 19:53:17', '2024-02-08 19:53:19');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
