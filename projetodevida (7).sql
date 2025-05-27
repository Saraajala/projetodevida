-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/05/2025 às 22:59
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projetodevida`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `areas_plano`
--

CREATE TABLE `areas_plano` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `areas_plano`
--

INSERT INTO `areas_plano` (`id`, `nome`) VALUES
(1, 'Relacionamento Familiar'),
(2, 'Estudos'),
(3, 'Saúde'),
(4, 'Futura Profissão'),
(5, 'Religião'),
(6, 'Amigos'),
(7, 'Namorado(a)'),
(8, 'Comunidade'),
(9, 'Tempo Livre');

-- --------------------------------------------------------

--
-- Estrutura para tabela `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL,
  `opiniao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `usuario_id`, `mensagem`, `data_envio`, `email`, `opiniao`) VALUES
(3, 1, NULL, '2025-05-07 17:14:39', 'sara.ajalasiva24@gmail.com', 'lindo'),
(4, 2, NULL, '2025-05-14 10:21:48', 'sara.ajalasiva24@gmail.com', 'hhshhshsh'),
(5, 2, NULL, '2025-05-14 16:07:41', 'sara.ajalasiva24@gmail.com', 'qwertyuiop'),
(6, 2, NULL, '2025-05-16 18:26:42', 'sara.ajalasiva24@gmail.com', 'sdfghjk'),
(7, 2, NULL, '2025-05-16 18:27:44', 'sara.ajalasiva24@gmail.com', 'sdfghjklç'),
(8, 2, NULL, '2025-05-21 10:28:58', 'sara.ajalasiva24@gmail.com', 'sdfghj');

-- --------------------------------------------------------

--
-- Estrutura para tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `id` int(11) NOT NULL,
  `pergunta` text DEFAULT NULL,
  `teste_id` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `perguntas`
--

INSERT INTO `perguntas` (`id`, `pergunta`, `teste_id`, `numero`) VALUES
(1, '1. Como você lida com desafios criativos?', NULL, 1),
(2, '2. Quando você observa um prédio ou um ambiente, o que mais chama sua atenção?', NULL, 2),
(3, '3. Você gosta de desenhar ou criar projetos visuais?', NULL, 3),
(4, '4. Como você se sente em relação a matemática e cálculos?', NULL, 4),
(5, '5. Você costuma reparar na organização dos espaços ao seu redor?', NULL, 5),
(6, '6. Como você lida com trabalho em equipe?', NULL, 6),
(7, '7. Você se interessa por tecnologia aplicada a construções e design?', NULL, 7),
(8, '8. Como você se sente ao lidar com prazos e projetos longos?', NULL, 8),
(9, '9. Você gosta de visitar museus, exposições de arte ou lugares históricos?', NULL, 9),
(10, '10. Como você lida com críticas e feedback sobre suas ideias?', NULL, 10),
(11, '11. Como você se sente ao trabalhar com softwares e ferramentas digitais para criação de projetos?', NULL, 11),
(12, '12. Quando você vê uma construção mal planejada ou um espaço desconfortável, qual é sua reação?', NULL, 12),
(13, '13. Como você se sente ao estudar história e teoria da arte e arquitetura?', NULL, 13),
(14, '14. Você gosta de experimentar diferentes estilos estéticos em seus projetos ou criações?', NULL, 14),
(15, '15. Se tivesse que projetar uma casa dos sonhos, o que mais te empolgaria?', NULL, 15);

-- --------------------------------------------------------

--
-- Estrutura para tabela `planejamento`
--

CREATE TABLE `planejamento` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `aprendendo` text DEFAULT NULL,
  `fazendo` text DEFAULT NULL,
  `preciso` text DEFAULT NULL,
  `meta_curto` text DEFAULT NULL,
  `meta_medio` text DEFAULT NULL,
  `meta_longo` text DEFAULT NULL,
  `data_atualizacao` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `planejamento`
--

INSERT INTO `planejamento` (`id`, `usuario_id`, `aprendendo`, `fazendo`, `preciso`, `meta_curto`, `meta_medio`, `meta_longo`, `data_atualizacao`) VALUES
(1, 2, 'poiuytrwqweruioiuds', 'sss', 'ddd', 'iiiiii', 'qqq', 'rrr', '2025-05-21 11:47:10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `planos_acao`
--

CREATE TABLE `planos_acao` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `area` varchar(100) NOT NULL,
  `passo1` text DEFAULT NULL,
  `passo2` text DEFAULT NULL,
  `passo3` text DEFAULT NULL,
  `como_irei_fazer` text DEFAULT NULL,
  `prazo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `profissao`
--

CREATE TABLE `profissao` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `profissao`
--

INSERT INTO `profissao` (`id`, `nome`, `descricao`, `imagem`) VALUES
(1, 'Arquiteto', 'Profissional responsável por projetar e planejar espaços urbanos e edificações. Trabalha com projetos de construção, interiores e paisagismo. Salário médio: R$ 6.000,00 mensais.', NULL),
(2, 'Urbanista', 'Profissional que estuda o planejamento e desenvolvimento das cidades, buscando soluções sustentáveis e eficientes para o uso do solo urbano. Salário médio: R$ 6.500,00 mensais.', NULL),
(3, 'Arquiteto de Interiores', 'Especialista no planejamento e design de espaços internos, focando no conforto, estética e funcionalidade. Salário médio: R$ 5.000,00 mensais.', NULL),
(4, 'Paisagista', 'Profissional que projeta áreas externas, como jardins e parques, utilizando princípios estéticos e ambientais para criar espaços verdes. Salário médio: R$ 4.500,00 mensais.', NULL),
(5, 'Consultor de Projetos de Sustentabilidade', 'Profissional que orienta na aplicação de práticas sustentáveis em projetos de arquitetura, como uso de energia renovável e construção ecológica. Salário médio: R$ 7.000,00 mensais.', NULL),
(6, 'Arquiteto de Software', 'Desenvolve e projeta soluções de software para arquitetos e engenheiros, criando ferramentas que auxiliam no planejamento e gestão de projetos arquitetônicos. Salário médio: R$ 8.000,00 mensais.', NULL),
(7, 'Engenheiro de Estruturas', 'Especializado em calcular e projetar as estruturas que sustentam os edifícios e outras construções. Trabalha em parceria com arquitetos para garantir a segurança e funcionalidade das obras. Salário médio: R$ 7.000,00 mensais.', NULL),
(8, 'Designer Urbano', 'Profissional que planeja e desenvolve o design de espaços públicos urbanos, como praças e ruas, focando na estética, acessibilidade e integração com a cidade. Salário médio: R$ 6.000,00 mensais.', NULL),
(9, 'Arquiteto e Urbanista', 'Profissional que trabalha tanto em projetos de arquitetura quanto no planejamento urbano, equilibrando as necessidades de construção com o desenvolvimento sustentável da cidade. Salário médio: R$ 7.000,00 mensais.', NULL),
(10, 'Restaurador de Patrimônios', 'Especialista na conservação e restauração de edificações históricas, buscando preservar o patrimônio cultural e arquitetônico de uma região. Salário médio: R$ 5.500,00 mensais.', NULL),
(11, 'Arquitetura de Luminotécnica', 'Profissional especializado no planejamento e projeto de sistemas de iluminação em edifícios e espaços urbanos, buscando harmonia entre estética e funcionalidade. Salário médio: R$ 6.500,00 mensais.', NULL),
(12, 'Arquitetura de Interiores Corporativos', 'Especialista em projetar ambientes internos para empresas, considerando a funcionalidade, ergonomia e estética do local. Salário médio: R$ 5.800,00 mensais.', NULL),
(13, 'Arquiteto de Acessibilidade', 'Foca no planejamento de espaços acessíveis para pessoas com deficiências, garantindo que as construções atendam às normas de acessibilidade. Salário médio: R$ 5.500,00 mensais.', NULL),
(14, 'Desenhista de Projetos', 'Profissional que auxilia na elaboração de plantas baixas e desenhos técnicos para projetos de arquitetura, trabalhando ao lado de arquitetos e engenheiros. Salário médio: R$ 3.500,00 mensais.', NULL),
(15, 'Arquiteto Hospitalar', 'Especialista em projetar espaços hospitalares e de saúde, criando ambientes que atendam às normas sanitárias e de segurança. Salário médio: R$ 7.500,00 mensais.', NULL),
(16, 'Arquiteto Comercial', 'Focado no design e planejamento de espaços comerciais, como lojas e escritórios, para maximizar a experiência do cliente e a funcionalidade do espaço. Salário médio: R$ 6.000,00 mensais.', NULL),
(17, 'Arquiteto de Meio Ambiente', 'Profissional que integra a arquitetura com o meio ambiente, projetando edifícios e espaços urbanos que respeitem e preservem o ecossistema local. Salário médio: R$ 6.200,00 mensais.', NULL),
(18, 'Geotecnólogo', 'Especialista no estudo das propriedades físicas e geográficas do solo, auxiliando arquitetos e urbanistas na escolha de locais para construção. Salário médio: R$ 5.200,00 mensais.', NULL),
(19, 'Projetista de Infraestrutura Urbana', 'Foca no planejamento e desenvolvimento das infraestruturas das cidades, como redes de esgoto, ruas, pontes e outros elementos essenciais. Salário médio: R$ 7.000,00 mensais.', NULL),
(20, 'Arquiteto de Realidade Virtual e Aumentada', 'Utiliza tecnologias de realidade virtual e aumentada para criar representações digitais de projetos arquitetônicos, facilitando a visualização dos espaços. Salário médio: R$ 8.000,00 mensais.', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostas`
--

CREATE TABLE `respostas` (
  `id` int(11) NOT NULL,
  `pergunta_id` int(11) DEFAULT NULL,
  `resposta` text DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `respostas`
--

INSERT INTO `respostas` (`id`, `pergunta_id`, `resposta`, `tipo`) VALUES
(1, 1, 'Adoro desafios e sempre busco soluções inovadoras.', 'A'),
(2, 1, 'Gosto de criatividade, mas prefiro seguir referências prontas.', 'B'),
(3, 1, 'Não sou muito criativo, mas gosto de resolver problemas práticos.', 'C'),
(4, 1, 'Evito desafios criativos, prefiro tarefas mais objetivas.', 'D'),
(5, 2, 'O design e os detalhes arquitetônicos.', 'A'),
(6, 2, 'A funcionalidade e como ele atende às necessidades das pessoas.', 'B'),
(7, 2, 'O impacto ambiental e sustentável da construção.', 'C'),
(8, 2, 'Apenas passo reto, sem prestar muita atenção.', 'D'),
(9, 3, 'Sim, adoro desenhar e imaginar novos espaços.', 'A'),
(10, 3, 'Gosto, mas não me sinto muito talentoso nisso.', 'B'),
(11, 3, 'Prefiro trabalhar com números e cálculos do que com desenho.', 'C'),
(12, 3, 'Não gosto de desenhar nem de criar projetos visuais.', 'D'),
(13, 4, 'Gosto e não tenho dificuldade com cálculos e medidas.', 'A'),
(14, 4, 'Não sou fã, mas consigo lidar bem com matemática quando necessário.', 'B'),
(15, 4, 'Tenho dificuldade com matemática, mas me interesso por design e criação.', 'C'),
(16, 4, 'Detesto matemática e evito ao máximo.', 'D'),
(17, 5, 'Sim, sempre observo como os espaços são organizados e como poderiam melhorar.', 'A'),
(18, 5, 'Às vezes reparo, mas não é algo que me chama muito a atenção.', 'B'),
(19, 5, 'Só percebo se o espaço estiver muito bagunçado ou desorganizado.', 'C'),
(20, 5, 'Não presto atenção nisso.', 'D'),
(21, 6, 'Gosto de colaborar e discutir ideias para encontrar as melhores soluções.', 'A'),
(22, 6, 'Trabalho bem em equipe, mas prefiro tarefas individuais.', 'B'),
(23, 6, 'Só gosto de trabalhar sozinho, não sou muito fã de discussões em grupo.', 'C'),
(24, 6, 'Tenho dificuldade de trabalhar com outras pessoas.', 'D'),
(25, 7, 'Sim, acho fascinante o uso de tecnologia na arquitetura e no design.', 'A'),
(26, 7, 'Gosto de tecnologia, mas prefiro áreas mais tradicionais.', 'B'),
(27, 7, 'Não tenho muito interesse em tecnologia aplicada à construção.', 'C'),
(28, 7, 'Não me interesso por tecnologia de forma geral.', 'D'),
(29, 8, 'Me organizo bem e gosto de desafios de longo prazo.', 'A'),
(30, 8, 'Consigo lidar com prazos, mas às vezes procrastino um pouco.', 'B'),
(31, 8, 'Tenho dificuldade em manter o foco em projetos longos.', 'C'),
(32, 8, 'Não gosto de projetos demorados, prefiro tarefas rápidas e diretas.', 'D'),
(33, 9, 'Sim, adoro observar a arquitetura e o design dos lugares.', 'A'),
(34, 9, 'Gosto, mas não é algo que faço com frequência.', 'B'),
(35, 9, 'Só vou quando sou obrigado ou por curiosidade ocasional.', 'C'),
(36, 9, 'Não me interesso por isso.', 'D'),
(37, 10, 'Vejo como uma oportunidade de melhorar e aprender mais.', 'A'),
(38, 10, 'Tento aceitar, mas às vezes me sinto desmotivado.', 'B'),
(39, 10, 'Fico um pouco incomodado, mas aceito se for necessário.', 'C'),
(40, 10, 'Não gosto de críticas, prefiro seguir minhas próprias ideias.', 'D'),
(41, 11, 'Adoro! Já me interesso por programas de design e modelagem 3D.', 'A'),
(42, 11, 'Tenho interesse, mas nunca tive muito contato com essas ferramentas.', 'B'),
(43, 11, 'Prefiro trabalhar com papel e lápis do que com softwares.', 'C'),
(44, 11, 'Não gosto de tecnologia aplicada ao design.', 'D'),
(45, 12, 'Penso imediatamente em como ele poderia ser melhorado.', 'A'),
(46, 12, 'Percebo o problema, mas não sei exatamente como resolver.', 'B'),
(47, 12, 'Só me incomodo se for algo muito óbvio.', 'C'),
(48, 12, 'Nem percebo esses detalhes.', 'D'),
(49, 13, 'Acho fascinante e gosto de entender a evolução do design e das construções.', 'A'),
(50, 13, 'Gosto, mas prefiro a parte prática da Arquitetura.', 'B'),
(51, 13, 'Não me interesso muito por teoria, prefiro cálculos e planejamento.', 'C'),
(52, 13, 'Acho desnecessário, prefiro assuntos mais técnicos e objetivos.', 'D'),
(53, 14, 'Sim, adoro explorar diferentes estilos e tendências de design.', 'A'),
(54, 14, 'Gosto, mas às vezes fico inseguro sobre minhas escolhas.', 'B'),
(55, 14, 'Prefiro seguir um estilo fixo sem muitas variações.', 'C'),
(56, 14, 'Não me interesso por estética, apenas pela funcionalidade.', 'D'),
(57, 15, 'Criar um design inovador e único.', 'A'),
(58, 15, 'Pensar em soluções funcionais para cada ambiente.', 'B'),
(59, 15, 'Calcular a estrutura e garantir que tudo fique seguro e viável.', 'C'),
(60, 15, 'Não tenho muito interesse nesse tipo de projeto.', 'D');

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostas_teste`
--

CREATE TABLE `respostas_teste` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `resposta_id` int(11) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `resposta` text DEFAULT NULL,
  `teste_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `respostas_teste`
--

INSERT INTO `respostas_teste` (`id`, `usuario_id`, `resposta_id`, `tipo`, `resposta`, `teste_id`) VALUES
(7, 1, 1, NULL, 'Adoro desafios e sempre busco soluções inovadoras.', 1746641234),
(8, 1, 6, NULL, 'A funcionalidade e como ele atende às necessidades das pessoas.', 1746641234),
(9, 1, 12, NULL, 'Não gosto de desenhar nem de criar projetos visuais.', 1746641234),
(10, 1, 14, NULL, 'Não sou fã, mas consigo lidar bem com matemática quando necessário.', 1746641234),
(11, 1, 20, NULL, 'Não presto atenção nisso.', 1746641234),
(12, 1, 21, NULL, 'Gosto de colaborar e discutir ideias para encontrar as melhores soluções.', 1746641234),
(13, 1, 27, NULL, 'Não tenho muito interesse em tecnologia aplicada à construção.', 1746641234),
(14, 1, 30, NULL, 'Consigo lidar com prazos, mas às vezes procrastino um pouco.', 1746641234),
(15, 1, 36, NULL, 'Não me interesso por isso.', 1746641234),
(16, 1, 37, NULL, 'Vejo como uma oportunidade de melhorar e aprender mais.', 1746641234),
(17, 1, 42, NULL, 'Tenho interesse, mas nunca tive muito contato com essas ferramentas.', 1746641234),
(18, 1, 47, NULL, 'Só me incomodo se for algo muito óbvio.', 1746641234),
(19, 1, 50, NULL, 'Gosto, mas prefiro a parte prática da Arquitetura.', 1746641234),
(20, 1, 53, NULL, 'Sim, adoro explorar diferentes estilos e tendências de design.', 1746641234),
(21, 1, 57, NULL, 'Criar um design inovador e único.', 1746641234),
(22, 1, 1, NULL, 'Adoro desafios e sempre busco soluções inovadoras.', 1746641268),
(23, 1, 6, NULL, 'A funcionalidade e como ele atende às necessidades das pessoas.', 1746641268),
(24, 1, 11, NULL, 'Prefiro trabalhar com números e cálculos do que com desenho.', 1746641268),
(25, 1, 16, NULL, 'Detesto matemática e evito ao máximo.', 1746641268),
(26, 1, 18, NULL, 'Às vezes reparo, mas não é algo que me chama muito a atenção.', 1746641268),
(27, 1, 21, NULL, 'Gosto de colaborar e discutir ideias para encontrar as melhores soluções.', 1746641268),
(28, 1, 27, NULL, 'Não tenho muito interesse em tecnologia aplicada à construção.', 1746641268),
(29, 1, 30, NULL, 'Consigo lidar com prazos, mas às vezes procrastino um pouco.', 1746641268),
(30, 1, 33, NULL, 'Sim, adoro observar a arquitetura e o design dos lugares.', 1746641268),
(31, 1, 40, NULL, 'Não gosto de críticas, prefiro seguir minhas próprias ideias.', 1746641268),
(32, 1, 41, NULL, 'Adoro! Já me interesso por programas de design e modelagem 3D.', 1746641268),
(33, 1, 46, NULL, 'Percebo o problema, mas não sei exatamente como resolver.', 1746641268),
(34, 1, 51, NULL, 'Não me interesso muito por teoria, prefiro cálculos e planejamento.', 1746641268),
(35, 1, 56, NULL, 'Não me interesso por estética, apenas pela funcionalidade.', 1746641268),
(36, 1, 57, NULL, 'Criar um design inovador e único.', 1746641268),
(37, 1, 1, 'A', 'Adoro desafios e sempre busco soluções inovadoras.', 1746642342),
(38, 1, 8, 'A', 'Apenas passo reto, sem prestar muita atenção.', 1746642342),
(39, 1, 12, 'A', 'Não gosto de desenhar nem de criar projetos visuais.', 1746642342),
(40, 1, 14, 'A', 'Não sou fã, mas consigo lidar bem com matemática quando necessário.', 1746642342),
(41, 1, 17, 'A', 'Sim, sempre observo como os espaços são organizados e como poderiam melhorar.', 1746642342),
(42, 1, 23, 'A', 'Só gosto de trabalhar sozinho, não sou muito fã de discussões em grupo.', 1746642342),
(43, 1, 25, 'A', 'Sim, acho fascinante o uso de tecnologia na arquitetura e no design.', 1746642342),
(44, 1, 31, 'A', 'Tenho dificuldade em manter o foco em projetos longos.', 1746642342),
(45, 1, 34, 'A', 'Gosto, mas não é algo que faço com frequência.', 1746642342),
(46, 1, 37, 'A', 'Vejo como uma oportunidade de melhorar e aprender mais.', 1746642342),
(47, 1, 43, 'A', 'Prefiro trabalhar com papel e lápis do que com softwares.', 1746642342),
(48, 1, 48, 'A', 'Nem percebo esses detalhes.', 1746642342),
(49, 1, 50, 'A', 'Gosto, mas prefiro a parte prática da Arquitetura.', 1746642342),
(50, 1, 53, 'A', 'Sim, adoro explorar diferentes estilos e tendências de design.', 1746642342),
(51, 1, 59, 'A', 'Calcular a estrutura e garantir que tudo fique seguro e viável.', 1746642342),
(52, 1, 1, 'A', 'Adoro desafios e sempre busco soluções inovadoras.', 1746642875),
(53, 1, 6, 'B', 'A funcionalidade e como ele atende às necessidades das pessoas.', 1746642875),
(54, 1, 9, 'A', 'Sim, adoro desenhar e imaginar novos espaços.', 1746642875),
(55, 1, 15, 'C', 'Tenho dificuldade com matemática, mas me interesso por design e criação.', 1746642875),
(56, 1, 20, 'D', 'Não presto atenção nisso.', 1746642875),
(57, 1, 21, 'A', 'Gosto de colaborar e discutir ideias para encontrar as melhores soluções.', 1746642875),
(58, 1, 27, 'C', 'Não tenho muito interesse em tecnologia aplicada à construção.', 1746642875),
(59, 1, 30, 'B', 'Consigo lidar com prazos, mas às vezes procrastino um pouco.', 1746642875),
(60, 1, 35, 'C', 'Só vou quando sou obrigado ou por curiosidade ocasional.', 1746642875),
(61, 1, 40, 'D', 'Não gosto de críticas, prefiro seguir minhas próprias ideias.', 1746642875),
(62, 1, 41, 'A', 'Adoro! Já me interesso por programas de design e modelagem 3D.', 1746642875),
(63, 1, 47, 'C', 'Só me incomodo se for algo muito óbvio.', 1746642875),
(64, 1, 50, 'B', 'Gosto, mas prefiro a parte prática da Arquitetura.', 1746642875),
(65, 1, 53, 'A', 'Sim, adoro explorar diferentes estilos e tendências de design.', 1746642875),
(66, 1, 58, 'B', 'Pensar em soluções funcionais para cada ambiente.', 1746642875),
(67, 1, 4, 'D', 'Evito desafios criativos, prefiro tarefas mais objetivas.', 1746642998),
(68, 1, 8, 'D', 'Apenas passo reto, sem prestar muita atenção.', 1746642998),
(69, 1, 12, 'D', 'Não gosto de desenhar nem de criar projetos visuais.', 1746642998),
(70, 1, 14, 'B', 'Não sou fã, mas consigo lidar bem com matemática quando necessário.', 1746642998),
(71, 1, 18, 'B', 'Às vezes reparo, mas não é algo que me chama muito a atenção.', 1746642998),
(72, 1, 23, 'C', 'Só gosto de trabalhar sozinho, não sou muito fã de discussões em grupo.', 1746642998),
(73, 1, 25, 'A', 'Sim, acho fascinante o uso de tecnologia na arquitetura e no design.', 1746642998),
(74, 1, 31, 'C', 'Tenho dificuldade em manter o foco em projetos longos.', 1746642998),
(75, 1, 36, 'D', 'Não me interesso por isso.', 1746642998),
(76, 1, 40, 'D', 'Não gosto de críticas, prefiro seguir minhas próprias ideias.', 1746642998),
(77, 1, 42, 'B', 'Tenho interesse, mas nunca tive muito contato com essas ferramentas.', 1746642998),
(78, 1, 46, 'B', 'Percebo o problema, mas não sei exatamente como resolver.', 1746642998),
(79, 1, 52, 'D', 'Acho desnecessário, prefiro assuntos mais técnicos e objetivos.', 1746642998),
(80, 1, 53, 'A', 'Sim, adoro explorar diferentes estilos e tendências de design.', 1746642998),
(81, 1, 60, 'D', 'Não tenho muito interesse nesse tipo de projeto.', 1746642998),
(82, 1, 2, 'B', 'Gosto de criatividade, mas prefiro seguir referências prontas.', 1747218151),
(83, 1, 8, 'D', 'Apenas passo reto, sem prestar muita atenção.', 1747218151),
(84, 1, 12, 'D', 'Não gosto de desenhar nem de criar projetos visuais.', 1747218151),
(85, 1, 14, 'B', 'Não sou fã, mas consigo lidar bem com matemática quando necessário.', 1747218151),
(86, 1, 18, 'B', 'Às vezes reparo, mas não é algo que me chama muito a atenção.', 1747218151),
(87, 1, 24, 'D', 'Tenho dificuldade de trabalhar com outras pessoas.', 1747218151),
(88, 1, 27, 'C', 'Não tenho muito interesse em tecnologia aplicada à construção.', 1747218151),
(89, 1, 29, 'A', 'Me organizo bem e gosto de desafios de longo prazo.', 1747218151),
(90, 1, 34, 'B', 'Gosto, mas não é algo que faço com frequência.', 1747218151),
(91, 1, 40, 'D', 'Não gosto de críticas, prefiro seguir minhas próprias ideias.', 1747218151),
(92, 1, 42, 'B', 'Tenho interesse, mas nunca tive muito contato com essas ferramentas.', 1747218151),
(93, 1, 47, 'C', 'Só me incomodo se for algo muito óbvio.', 1747218151),
(94, 1, 49, 'A', 'Acho fascinante e gosto de entender a evolução do design e das construções.', 1747218151),
(95, 1, 54, 'B', 'Gosto, mas às vezes fico inseguro sobre minhas escolhas.', 1747218151),
(96, 1, 57, 'A', 'Criar um design inovador e único.', 1747218151),
(97, 1, 1, 'A', 'Adoro desafios e sempre busco soluções inovadoras.', 1747218251),
(98, 1, 8, 'D', 'Apenas passo reto, sem prestar muita atenção.', 1747218251),
(99, 1, 11, 'C', 'Prefiro trabalhar com números e cálculos do que com desenho.', 1747218251),
(100, 1, 13, 'A', 'Gosto e não tenho dificuldade com cálculos e medidas.', 1747218251),
(101, 1, 18, 'B', 'Às vezes reparo, mas não é algo que me chama muito a atenção.', 1747218251),
(102, 1, 23, 'C', 'Só gosto de trabalhar sozinho, não sou muito fã de discussões em grupo.', 1747218251),
(103, 1, 25, 'A', 'Sim, acho fascinante o uso de tecnologia na arquitetura e no design.', 1747218251),
(104, 1, 32, 'D', 'Não gosto de projetos demorados, prefiro tarefas rápidas e diretas.', 1747218251),
(105, 1, 33, 'A', 'Sim, adoro observar a arquitetura e o design dos lugares.', 1747218251),
(106, 1, 38, 'B', 'Tento aceitar, mas às vezes me sinto desmotivado.', 1747218251),
(107, 1, 43, 'C', 'Prefiro trabalhar com papel e lápis do que com softwares.', 1747218251),
(108, 1, 48, 'D', 'Nem percebo esses detalhes.', 1747218251),
(109, 1, 49, 'A', 'Acho fascinante e gosto de entender a evolução do design e das construções.', 1747218251),
(110, 1, 54, 'B', 'Gosto, mas às vezes fico inseguro sobre minhas escolhas.', 1747218251),
(111, 1, 60, 'D', 'Não tenho muito interesse nesse tipo de projeto.', 1747218251),
(112, 1, 1, 'A', 'Adoro desafios e sempre busco soluções inovadoras.', 1747223868),
(113, 1, 5, 'A', 'O design e os detalhes arquitetônicos.', 1747223868),
(114, 1, 11, 'C', 'Prefiro trabalhar com números e cálculos do que com desenho.', 1747223868),
(115, 1, 13, 'A', 'Gosto e não tenho dificuldade com cálculos e medidas.', 1747223868),
(116, 1, 18, 'B', 'Às vezes reparo, mas não é algo que me chama muito a atenção.', 1747223868),
(117, 1, 23, 'C', 'Só gosto de trabalhar sozinho, não sou muito fã de discussões em grupo.', 1747223868),
(118, 1, 25, 'A', 'Sim, acho fascinante o uso de tecnologia na arquitetura e no design.', 1747223868),
(119, 1, 32, 'D', 'Não gosto de projetos demorados, prefiro tarefas rápidas e diretas.', 1747223868),
(120, 1, 33, 'A', 'Sim, adoro observar a arquitetura e o design dos lugares.', 1747223868),
(121, 1, 38, 'B', 'Tento aceitar, mas às vezes me sinto desmotivado.', 1747223868),
(122, 1, 43, 'C', 'Prefiro trabalhar com papel e lápis do que com softwares.', 1747223868),
(123, 1, 48, 'D', 'Nem percebo esses detalhes.', 1747223868),
(124, 1, 49, 'A', 'Acho fascinante e gosto de entender a evolução do design e das construções.', 1747223868),
(125, 1, 54, 'B', 'Gosto, mas às vezes fico inseguro sobre minhas escolhas.', 1747223868),
(126, 1, 60, 'D', 'Não tenho muito interesse nesse tipo de projeto.', 1747223868),
(127, 1, 2, 'B', 'Gosto de criatividade, mas prefiro seguir referências prontas.', 1747419590),
(128, 1, 8, 'D', 'Apenas passo reto, sem prestar muita atenção.', 1747419590),
(129, 1, 10, 'B', 'Gosto, mas não me sinto muito talentoso nisso.', 1747419590),
(130, 1, 13, 'A', 'Gosto e não tenho dificuldade com cálculos e medidas.', 1747419590),
(131, 1, 18, 'B', 'Às vezes reparo, mas não é algo que me chama muito a atenção.', 1747419590),
(132, 1, 23, 'C', 'Só gosto de trabalhar sozinho, não sou muito fã de discussões em grupo.', 1747419590),
(133, 1, 25, 'A', 'Sim, acho fascinante o uso de tecnologia na arquitetura e no design.', 1747419590),
(134, 1, 30, 'B', 'Consigo lidar com prazos, mas às vezes procrastino um pouco.', 1747419590),
(135, 1, 36, 'D', 'Não me interesso por isso.', 1747419590),
(136, 1, 37, 'A', 'Vejo como uma oportunidade de melhorar e aprender mais.', 1747419590),
(137, 1, 44, 'D', 'Não gosto de tecnologia aplicada ao design.', 1747419590),
(138, 1, 47, 'C', 'Só me incomodo se for algo muito óbvio.', 1747419590),
(139, 1, 50, 'B', 'Gosto, mas prefiro a parte prática da Arquitetura.', 1747419590),
(140, 1, 53, 'A', 'Sim, adoro explorar diferentes estilos e tendências de design.', 1747419590),
(141, 1, 59, 'C', 'Calcular a estrutura e garantir que tudo fique seguro e viável.', 1747419590),
(142, 1, 1, 'A', 'Adoro desafios e sempre busco soluções inovadoras.', 1747839281),
(143, 1, 6, 'B', 'A funcionalidade e como ele atende às necessidades das pessoas.', 1747839281),
(144, 1, 11, 'C', 'Prefiro trabalhar com números e cálculos do que com desenho.', 1747839281),
(145, 1, 14, 'B', 'Não sou fã, mas consigo lidar bem com matemática quando necessário.', 1747839281),
(146, 1, 17, 'A', 'Sim, sempre observo como os espaços são organizados e como poderiam melhorar.', 1747839281),
(147, 1, 24, 'D', 'Tenho dificuldade de trabalhar com outras pessoas.', 1747839281),
(148, 1, 25, 'A', 'Sim, acho fascinante o uso de tecnologia na arquitetura e no design.', 1747839281),
(149, 1, 31, 'C', 'Tenho dificuldade em manter o foco em projetos longos.', 1747839281),
(150, 1, 34, 'B', 'Gosto, mas não é algo que faço com frequência.', 1747839281),
(151, 1, 40, 'D', 'Não gosto de críticas, prefiro seguir minhas próprias ideias.', 1747839281),
(152, 1, 41, 'A', 'Adoro! Já me interesso por programas de design e modelagem 3D.', 1747839281),
(153, 1, 46, 'B', 'Percebo o problema, mas não sei exatamente como resolver.', 1747839281),
(154, 1, 51, 'C', 'Não me interesso muito por teoria, prefiro cálculos e planejamento.', 1747839281),
(155, 1, 56, 'D', 'Não me interesso por estética, apenas pela funcionalidade.', 1747839281),
(156, 1, 57, 'A', 'Criar um design inovador e único.', 1747839281);

-- --------------------------------------------------------

--
-- Estrutura para tabela `resultados`
--

CREATE TABLE `resultados` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `teste_id` int(11) DEFAULT NULL,
  `resultado` char(1) DEFAULT NULL,
  `interpretacao` text DEFAULT NULL,
  `imagem_resultado` varchar(255) DEFAULT NULL,
  `data_resultado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `testes`
--

CREATE TABLE `testes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `teste_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `testes`
--

INSERT INTO `testes` (`id`, `titulo`, `descricao`, `teste_id`) VALUES
(1, 'Teste de Personalidade', NULL, 0),
(1746641234, 'Teste de Personalidade', NULL, 0),
(1746641268, 'Teste de Personalidade', NULL, 0),
(1746642342, 'Teste de Personalidade', NULL, 0),
(1746642875, 'Teste de Personalidade', NULL, 0),
(1746642998, 'Teste de Personalidade', NULL, 0),
(1747218151, 'Teste de Personalidade', NULL, 0),
(1747218251, 'Teste de Personalidade', NULL, 0),
(1747223868, 'Teste de Personalidade', NULL, 0),
(1747419590, 'Teste de Personalidade', NULL, 0),
(1747839281, 'Teste de Personalidade', NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `teste_realizado`
--

CREATE TABLE `teste_realizado` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `teste_id` int(11) DEFAULT NULL,
  `data_realizacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `sobre_mim` text DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_nascimento`, `sobre_mim`, `foto_perfil`, `criado_em`) VALUES
(1, 'Teste', 'teste@email.com', '123456', NULL, NULL, NULL, '2025-05-07 17:14:32'),
(2, 'sara', 'sara.ajalasiva24@gmail.com', '$2y$10$tU6bAyYGk1bh2d2kuvz9h.5nJLT1p2YGLwo8DfrjlNg.TUL5OI0aS', '2007-07-24', 'sara Ajala Silva', 'perfil_6830bf69e38721.09484339.jpg', '2025-05-07 17:15:21'),
(4, 'rafa', 'rafa@rafa.com', '$2y$10$eDfvh8axOLl5Q4MgGM8MA.nSbAndReDmN1LgkdvGiIkmzlYjRvHES', '1970-01-01', NULL, NULL, '2025-05-21 11:15:43'),
(5, 'bernini', 'bernini@gmail.com', '$2y$10$FMcSXcCpR5folRBAcRWo7OFbT0EWKasWtEsdmNkhH71PiROEriAry', '1988-03-24', 'rafael', 'perfil_6824c7939f0022.43796925', '2025-05-21 11:50:43'),
(6, 'rafaebernini', 'rafaelbernini@gmail.com', '123456', '2007-07-24', 'Sor Rafa', 'perfil_682dcd3a9ae6c9.11636084.png', '2025-05-21 12:00:37'),
(16, 'jonatas', 'jojo@123.com', '$2y$10$f/KvEMQh9O1JjnevgPGBAeZIlV7AbOgjduDv22lTwwqBzwzeOILFu', '0000-00-00', NULL, NULL, '2025-05-21 12:26:38'),
(17, 'maria', 'maria@maria.com', '$2y$10$KmrtY9cl61TLg3bOM9mMxuZCrgLO.KNjJgoyoCa5lxwPB2QZsK8ye', '0000-00-00', NULL, NULL, '2025-05-21 12:41:46'),
(18, 'ze', 'ze@ze.com', '$2y$10$9afBdQrrXZMBr.GO2QFE4O2kF1UYU2z1.AVzmpcTzFURpH8xP7d2m', '0000-00-00', NULL, NULL, '2025-05-21 12:44:24'),
(19, 'vi', 'viviane.ajala@gmail.com', '$2y$10$s1Cyw/SnK22oxWLs3V1S4uEYhtNQ.HMHKwHAXHftnWUCTq2eccxrS', '0000-00-00', NULL, NULL, '2025-05-21 13:38:04'),
(20, 'yugi', 'yugi@magonegro.com', '$2y$10$XXDHQ0lU45Vprtjoc.OmA.MPWBdMCIvruYc81V6QDc0fUvgbEqYRu', '0000-00-00', NULL, NULL, '2025-05-21 13:47:03'),
(21, 'kayba', 'kayba@dragaobranco.com', '$2y$10$.Tqmq6xYwM5L0DZd8VVn8OTxfmHLy2SxhxTpr2C.1ZbciS9O3zRGa', '0000-00-00', NULL, NULL, '2025-05-21 13:50:06'),
(22, 'daniel', 'dani@123.com', '$2y$10$eh/9a33lGBpkuZBPJm0T7uMn0e7tFCVp.9qIQ.FrJgHUeFPCH.mGW', '1998-11-05', NULL, NULL, '2025-05-21 13:57:26');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `areas_plano`
--
ALTER TABLE `areas_plano`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teste_id` (`teste_id`);

--
-- Índices de tabela `planejamento`
--
ALTER TABLE `planejamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `planos_acao`
--
ALTER TABLE `planos_acao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `profissao`
--
ALTER TABLE `profissao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `respostas`
--
ALTER TABLE `respostas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pergunta_id` (`pergunta_id`);

--
-- Índices de tabela `respostas_teste`
--
ALTER TABLE `respostas_teste`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `resposta_id` (`resposta_id`),
  ADD KEY `teste_id` (`teste_id`);

--
-- Índices de tabela `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `teste_id` (`teste_id`);

--
-- Índices de tabela `testes`
--
ALTER TABLE `testes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `teste_realizado`
--
ALTER TABLE `teste_realizado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `teste_id` (`teste_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `areas_plano`
--
ALTER TABLE `areas_plano`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `planejamento`
--
ALTER TABLE `planejamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `planos_acao`
--
ALTER TABLE `planos_acao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `profissao`
--
ALTER TABLE `profissao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `respostas`
--
ALTER TABLE `respostas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `respostas_teste`
--
ALTER TABLE `respostas_teste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT de tabela `resultados`
--
ALTER TABLE `resultados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `testes`
--
ALTER TABLE `testes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1747839282;

--
-- AUTO_INCREMENT de tabela `teste_realizado`
--
ALTER TABLE `teste_realizado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `perguntas`
--
ALTER TABLE `perguntas`
  ADD CONSTRAINT `perguntas_ibfk_1` FOREIGN KEY (`teste_id`) REFERENCES `testes` (`id`);

--
-- Restrições para tabelas `planejamento`
--
ALTER TABLE `planejamento`
  ADD CONSTRAINT `planejamento_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `planos_acao`
--
ALTER TABLE `planos_acao`
  ADD CONSTRAINT `planos_acao_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `respostas`
--
ALTER TABLE `respostas`
  ADD CONSTRAINT `respostas_ibfk_1` FOREIGN KEY (`pergunta_id`) REFERENCES `perguntas` (`id`);

--
-- Restrições para tabelas `respostas_teste`
--
ALTER TABLE `respostas_teste`
  ADD CONSTRAINT `respostas_teste_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `respostas_teste_ibfk_2` FOREIGN KEY (`resposta_id`) REFERENCES `respostas` (`id`),
  ADD CONSTRAINT `respostas_teste_ibfk_3` FOREIGN KEY (`teste_id`) REFERENCES `testes` (`id`);

--
-- Restrições para tabelas `resultados`
--
ALTER TABLE `resultados`
  ADD CONSTRAINT `resultados_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `resultados_ibfk_2` FOREIGN KEY (`teste_id`) REFERENCES `testes` (`id`);

--
-- Restrições para tabelas `teste_realizado`
--
ALTER TABLE `teste_realizado`
  ADD CONSTRAINT `teste_realizado_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `teste_realizado_ibfk_2` FOREIGN KEY (`teste_id`) REFERENCES `testes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
