<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Theme;
use App\Models\User;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //* Fetch the Cybersecurity and Artificial Intelligence themes
        $cybersecurityTheme = Theme::where('title', 'Cybersecurity')->first();
        $aiTheme = Theme::where('title', 'Artificial Intelligence (AI)')->first();
        $cloudComputingTheme = Theme::where('title', 'Cloud Computing')->first();
        $gameDevelopmentTheme = Theme::where('title', 'Game Development')->first();
        $dataScienceTheme = Theme::where('title', 'Data Science')->first();
        $iotTheme = Theme::where('title', 'Internet of Things (IoT)')->first();


        //* Fetch a user to act as the author (assuming at least one user exists)
        $author1 = User::first();


        $articles = [
            //* Cybersecurity Articles
            [
                'title' => 'The Evolution of Cybersecurity: From Antivirus to AI-Powered Protection',
                'description' => 'This article explores how cybersecurity technologies have advanced over the decades, transitioning from basic antivirus programs to modern AI-driven solutions. It highlights key milestones and how these advancements have addressed evolving cyber threats.',
                'content' => 'Cybersecurity has undergone a remarkable transformation over the past few decades. Initially, it focused on simple antivirus software designed to detect and remove malware from personal computers. Early cybersecurity efforts were reactionary, aimed at combating known threats like viruses and worms. However, as technology advanced, so did the methods of cyber attackers. With the rise of the internet, threats became more sophisticated, giving birth to firewalls and intrusion detection systems to safeguard networks. The shift to cloud computing and the proliferation of connected devices further complicated the landscape, requiring more robust solutions. Today, artificial intelligence (AI) plays a pivotal role in cybersecurity, enabling real-time threat detection and predictive analytics. AI-powered systems can analyze vast amounts of data, recognize unusual patterns, and respond to threats before they cause harm. This evolution reflects the ever-growing need for advanced measures to protect sensitive information in an increasingly connected world.',
                'theme_id' => $cybersecurityTheme->id,
                'author_id' => $author1->id,
                'ispublic' => true,
                'image' => 'https://images.pexels.com/photos/1089438/pexels-photo-1089438.jpeg',
            ],
            [
                'title' => 'Top 10 Cybersecurity Threats to Watch Out for in 2025',
                'description' => 'A forward-looking piece that outlines the most significant cybersecurity risks expected in 2025, such as advanced phishing schemes, AI-driven malware, and vulnerabilities in emerging technologies.',
                'content' => 'As we approach 2025, the digital world faces a growing array of cybersecurity threats that challenge individuals, organizations, and governments. One major concern is the rise of AI-driven malware, capable of evading traditional security measures through adaptive learning. Phishing attacks are also becoming more sophisticated, using deepfake technology to impersonate trusted individuals or entities. Ransomware attacks continue to evolve, targeting critical infrastructure like healthcare systems and energy grids. Additionally, the growing adoption of IoT devices introduces vulnerabilities, as many lack robust security features. Quantum computing poses another emerging threat, with the potential to break traditional encryption methods. Social engineering attacks are expected to exploit human psychology more effectively, bypassing even the most secure technical defenses. Supply chain attacks, where cybercriminals target third-party vendors, are on the rise as well. To address these challenges, organizations must adopt a proactive approach, leveraging AI, zero-trust architectures, and regular security assessments.',
                'theme_id' => $cybersecurityTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.pexels.com/photos/5380642/pexels-photo-5380642.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            ],
            [
                'title' => 'The Role of Ethical Hacking in Strengthening Digital Defenses',
                'description' => 'This article discusses how ethical hackers (white hats) identify and address security vulnerabilities. It also explains their methodologies and how organizations can leverage their expertise to build robust defense systems.',
                'content' => 'Ethical hacking, often referred to as penetration testing, has become a cornerstone of modern cybersecurity. Ethical hackers, or white hats, are professionals authorized to test an organization\'s systems for vulnerabilities. Unlike malicious hackers, ethical hackers use their skills to strengthen defenses by identifying weaknesses before cybercriminals can exploit them. They employ various techniques, such as social engineering, network scanning, and vulnerability exploitation, to simulate real-world attacks. By providing detailed reports on their findings, they enable organizations to address security gaps effectively. Ethical hacking also plays a crucial role in compliance with regulations like GDPR and HIPAA, which mandate regular security assessments. Moreover, ethical hackers contribute to the development of more secure software by exposing flaws during the design phase. As cyber threats grow in complexity, the demand for skilled ethical hackers continues to rise, making their role indispensable in protecting sensitive information.',
                'theme_id' => $cybersecurityTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.pexels.com/photos/5380664/pexels-photo-5380664.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            ],
            [
                'title' => 'How Businesses Can Safeguard Against Ransomware Attacks',
                'description' => 'Focused on actionable strategies, this piece provides businesses with guidelines to prevent, detect, and recover from ransomware attacks. Topics include backup practices, employee training, and deploying advanced security tools.',
                'content' => 'Ransomware attacks have become one of the most devastating forms of cybercrime, locking victims out of their systems and demanding payment for restoration. To combat this threat, businesses must adopt a comprehensive cybersecurity strategy. One essential measure is implementing a robust backup system that stores data in secure, offsite locations. Regularly updating software and systems is also crucial, as outdated versions often contain vulnerabilities that attackers exploit. Employee training is another critical component, as phishing emails remain a common entry point for ransomware. Businesses should also invest in advanced threat detection tools, such as endpoint protection platforms (EPPs) and extended detection and response (XDR) systems, to identify and mitigate risks in real-time. Developing a detailed incident response plan ensures a swift and effective reaction to an attack, minimizing downtime and data loss. Ultimately, a proactive approach to cybersecurity is the best defense against the ever-evolving threat of ransomware.',
                'theme_id' => $cybersecurityTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'title' => 'Cybersecurity in the Age of Quantum Computing: Opportunities and Challenges',
                'description' => 'This article examines how quantum computing could impact cybersecurity, including the potential to crack existing encryption methods. It also explores opportunities for creating quantum-resistant algorithms.',
                'content' => 'Quantum computing represents a paradigm shift in technology, with the potential to revolutionize fields such as healthcare, finance, and artificial intelligence. However, it also poses significant challenges to cybersecurity. Traditional encryption methods, such as RSA and ECC, rely on the difficulty of factoring large numbers or solving discrete logarithm problems—tasks that quantum computers could perform exponentially faster than classical computers. This capability threatens the security of sensitive data, financial transactions, and communication networks. To address this looming threat, researchers are developing quantum-resistant cryptographic algorithms that can withstand attacks from quantum computers. On the other hand, quantum computing offers opportunities to enhance cybersecurity, such as generating truly random encryption keys and improving threat detection algorithms. Governments and organizations must prepare for the quantum era by investing in research and transitioning to quantum-safe encryption methods. Proactive measures taken today will determine the resilience of tomorrow\'s cybersecurity landscape.',
                'theme_id' => $cybersecurityTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://plus.unsplash.com/premium_photo-1661877737564-3dfd7282efcb?q=80&w=2100&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'title' => 'Building a Career in Cybersecurity: Skills and Certifications Needed',
                'description' => 'A career-oriented guide detailing the skills, certifications (e.g., CISSP, CEH), and learning paths required to enter and thrive in the cybersecurity field. It also provides tips for beginners and experienced professionals.',
                'content' => 'The demand for cybersecurity professionals has skyrocketed as cyber threats become more prevalent and sophisticated. Building a career in this dynamic field requires a combination of technical skills, certifications, and practical experience. Key skills include understanding networking fundamentals, operating systems, and programming languages like Python and C++. Familiarity with tools such as Wireshark, Metasploit, and Splunk is also valuable. Certifications like CompTIA Security+, Certified Ethical Hacker (CEH), and Certified Information Systems Security Professional (CISSP) provide a strong foundation and are often prerequisites for advanced roles. Additionally, specialized certifications in areas like penetration testing, cloud security, and incident response can enhance career prospects. Gaining hands-on experience through internships, labs, and bug bounty programs is equally important. Soft skills such as problem-solving, communication, and adaptability play a vital role in collaborating with teams and addressing complex challenges. With dedication and continuous learning, aspiring cybersecurity professionals can build a rewarding and impactful career.',
                'theme_id' => $cybersecurityTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.pexels.com/photos/5380792/pexels-photo-5380792.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            ],
            //* Artificial Intelligence Articles
            [
                'title' => 'How AI Is Revolutionizing Healthcare: Diagnostics and Beyond',
                'description' => 'This article explores how AI is transforming the healthcare industry, from improving diagnostic accuracy and predicting disease outcomes to enhancing personalized treatment plans. It also looks at AI\'s role in streamlining administrative tasks and revolutionizing drug development.',
                'content' => 'The healthcare sector has long been a field ripe for innovation, and in recent years, Artificial Intelligence (AI) has emerged as a transformative force. AI’s impact on healthcare begins with its ability to enhance diagnostics. Machine learning algorithms, particularly deep learning models, have demonstrated incredible proficiency in interpreting medical data, such as medical imaging (X-rays, MRIs, and CT scans). These AI tools can identify early signs of diseases such as cancer, heart conditions, and neurological disorders, often with greater accuracy and speed than human specialists. AI’s potential in diagnostics goes beyond imaging; for instance, algorithms can now analyze patient records and genetic data to predict risks and suggest personalized treatments. But AI’s role doesn’t end with diagnosis. It extends into the management of patient care by offering tailored treatment recommendations based on a patient’s medical history, lifestyle, and genetic profile. In drug development, AI accelerates the discovery of new medicines by predicting how different chemical compounds will interact, drastically reducing the time and cost of bringing a drug to market. Furthermore, AI is improving hospital operations, streamlining administrative tasks such as patient scheduling, billing, and documentation through natural language processing. While the adoption of AI in healthcare promises to improve outcomes, it also raises challenges, such as data privacy issues, algorithmic bias, and the need for clear regulations. As the technology matures, balancing AI\'s benefits with ethical considerations will be essential to ensure equitable access and patient safety.',
                'theme_id' => $aiTheme->id,
                'author_id' => $author1->id,
                'ispublic' => true,
                'image' => 'https://images.pexels.com/photos/8386440/pexels-photo-8386440.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            ],
            [
                'title' => 'The Ethics of Artificial Intelligence: Striking a Balance Between Progress and Privacy',
                'description' => 'This article delves into the ethical concerns surrounding AI, focusing on how the rapid advancement of AI technologies can potentially infringe on personal privacy, increase bias, or disrupt employment. It emphasizes the need for responsible AI development that respects individual rights and societal norms.',
                'content' => 'As Artificial Intelligence continues to advance, it introduces a host of ethical questions that society must address. One of the central concerns is privacy. AI systems often rely on vast amounts of data, much of which is personal and sensitive, such as health records, financial information, and online behaviors. This data is essential for training AI models, but it also raises concerns about how this information is collected, used, and protected. The challenge lies in striking a balance between utilizing data to create more efficient, intelligent systems and safeguarding individuals\' privacy rights. Ethical AI development calls for transparency in how data is gathered and used, ensuring that individuals have control over their personal information. Another critical issue is algorithmic bias. Since AI systems learn from historical data, they may inadvertently perpetuate existing biases present in the data, leading to discriminatory outcomes, particularly in areas like hiring, criminal justice, and lending. This is especially concerning in high-stakes applications where AI decisions can affect people’s lives and liberties. The issue of job displacement due to AI automation is also gaining attention. While AI can drive efficiency, it has the potential to eliminate many routine jobs, leading to widespread unemployment in some sectors. The ethical responsibility of businesses and governments to provide retraining and reskilling opportunities for displaced workers is essential. To ensure that AI serves society positively, developers must consider these ethical implications throughout the development process, focusing on fairness, accountability, transparency, and respect for human rights.',
                'theme_id' => $aiTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.pexels.com/photos/8849295/pexels-photo-8849295.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            ],
            [
                'title' => 'From Chatbots to GPT: The Evolution of AI in Communication',
                'description' => 'This piece traces the development of AI-driven communication tools, from early chatbots to advanced systems like GPT (Generative Pre-trained Transformers). It highlights how these technologies are changing the way humans interact with machines, enabling more natural and intuitive conversations.',
                'content' => 'Artificial Intelligence has made remarkable strides in communication technologies, evolving from basic chatbots to advanced models like GPT (Generative Pre-trained Transformers), which have revolutionized the way humans interact with machines. Early chatbots, such as ELIZA and AIML-based bots, were rule-based systems that could perform simple, predefined responses to user queries. While they could simulate conversations, their abilities were limited and often led to frustrating user experiences. However, the development of AI systems like GPT has marked a significant leap in the capabilities of conversational agents. GPT, a deep learning model developed by OpenAI, uses a vast amount of text data from the internet to understand and generate human-like language. GPT can answer questions, summarize text, write essays, and even generate creative works, making it an invaluable tool for communication. Its ability to understand context and nuance in language has led to its integration into customer service, where chatbots powered by GPT can handle complex inquiries with near-human proficiency. Beyond customer service, AI-driven communication tools are being used in mental health counseling, education, and content creation. For instance, in education, AI tutors can provide personalized learning experiences for students, adapting to their progress and offering support where needed. In mental health, AI-powered platforms can offer therapeutic conversations and emotional support, helping to bridge the gap in access to mental health services. As AI in communication continues to evolve, it raises important questions about trust and authenticity. How can users distinguish between human and machine-generated content, and what are the implications for privacy and misinformation? These are crucial issues to consider as AI reshapes communication in our daily lives.',
                'theme_id' => $aiTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://plus.unsplash.com/premium_photo-1683121710572-7723bd2e235d?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'title' => 'Exploring AI-Powered Tools for Small Businesses',
                'description' => 'This article examines the AI tools available to small businesses, focusing on how they can automate operations, improve customer service, enhance marketing strategies, and optimize resource management, helping small businesses become more competitive and efficient.',
                'content' => 'Small businesses often face significant challenges when competing with larger corporations, particularly when it comes to resources and technological capabilities. However, the rise of AI-powered tools has leveled the playing field, enabling small businesses to automate processes, enhance customer experiences, and improve decision-making. One of the most accessible AI tools for small businesses is the AI-powered chatbot. These chatbots can handle a wide range of customer interactions, from answering frequently asked questions to processing orders and even resolving common customer service issues. This 24/7 availability can significantly enhance customer satisfaction without requiring additional staff. Predictive analytics is another powerful AI tool that can help small businesses optimize inventory, forecast demand, and tailor marketing strategies. By analyzing historical data and identifying trends, AI tools can predict customer behavior, allowing businesses to make informed decisions about pricing, promotions, and stock management. Additionally, AI-driven automation tools can streamline administrative tasks, such as invoicing, payroll, and scheduling, reducing the time spent on manual tasks and allowing business owners to focus on strategic growth. In marketing, AI tools like personalized recommendation engines can offer tailored content to customers, increasing engagement and sales. AI also assists in social media management by automatically scheduling posts, analyzing engagement, and optimizing content strategies. By adopting these AI-powered tools, small businesses can operate more efficiently, offer better customer service, and improve their marketing efforts, all while keeping costs manageable.',
                'theme_id' => $aiTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.unsplash.com/photo-1516110833967-0b5716ca1387?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'title' => 'AI and Art: Can Machines Be Creative?',
                'description' => 'This article discusses the role of AI in the creative industries, questioning whether machines can truly be creative. It explores examples of AI-generated art, music, and literature and discusses the implications of AI\'s involvement in artistic expression and its potential to redefine creativity.',
                'content' => 'The intersection of Artificial Intelligence and creativity has sparked a fascinating debate about whether machines can truly be creative. AI’s role in the art world has evolved rapidly, with machines now capable of generating visual art, music, poetry, and even narratives that rival human creations in some respects. Using deep learning techniques such as neural networks, AI can analyze and learn from vast datasets of artwork, understanding patterns, colors, and styles. Based on this knowledge, AI systems can create new pieces of art that emulate famous painters or invent entirely new forms of expression. AI-generated art challenges traditional notions of creativity, which have long been associated with human intuition, emotion, and personal experience. Some critics argue that AI lacks the genuine creativity that humans possess because it does not experience the world in the same way. AI’s creative output is driven by data and algorithms, not by personal experiences or emotions. However, others see AI as a powerful tool that can augment human creativity. AI can serve as a collaborator for artists, offering novel perspectives and techniques that might not be possible through human effort alone. For instance, AI-generated music can explore new genres and styles, and AI algorithms can assist writers in generating plots, characters, and dialogues. Despite the philosophical questions about machine creativity, AI is undeniably expanding the possibilities for artistic expression, offering artists new avenues for experimentation and innovation. As AI continues to evolve, it may redefine the boundaries of what constitutes creativity.',
                'theme_id' => $aiTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://plus.unsplash.com/premium_photo-1683121716061-3faddf4dc504?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'title' => 'The Future of Work: How AI Will Transform Industries by 2030',
                'description' => 'This article predicts how AI will reshape various industries by 2030, focusing on automation, job displacement, and the creation of new opportunities. It explores the impact of AI on the workforce, including changes in skill sets, job roles, and the rise of AI-assisted decision-making in the workplace.',
                'content' => 'The future of work is poised for dramatic transformation, driven by the increasing integration of Artificial Intelligence across various industries. By 2030, AI is expected to fundamentally reshape how businesses operate, how employees perform their jobs, and how industries deliver goods and services. One of the most significant impacts of AI will be the automation of routine, repetitive tasks. In manufacturing, for example, robots powered by AI will take over jobs that involve manual labor, such as assembly line work, quality control, and packaging. Similarly, in sectors like retail and customer service, AI-powered systems will handle tasks like inventory management, order fulfillment, and answering customer inquiries, reducing the need for human labor. While this automation will lead to increased efficiency and lower costs, it also raises concerns about job displacement, especially in lower-skill, manual roles. However, AI is also expected to create new job opportunities in areas such as AI development, data science, and machine learning engineering, as well as in industries that require human oversight and collaboration with machines. Workers will need to acquire new skills to stay competitive in the AI-driven economy, particularly in fields that require creativity, emotional intelligence, and complex problem-solving—areas where AI still lags behind human capabilities. AI will also enable industries to make data-driven decisions, improving everything from supply chain management to marketing strategies. In healthcare, AI will assist in diagnosing diseases and creating personalized treatment plans, while in finance, AI will optimize investment strategies and detect fraudulent activities. The workforce of 2030 will be one of collaboration between humans and machines, where AI handles the routine, allowing people to focus on higher-level, creative, and strategic tasks. While the future of work with AI presents challenges, it also holds the promise of greater productivity, innovation, and a more dynamic job market.',
                'theme_id' => $aiTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://plus.unsplash.com/premium_photo-1682124651258-410b25fa9dc0?q=80&w=1921&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            //* Cloud Computing Articles 
            [
                'title' => 'Understanding the Different Types of Cloud Computing (Public, Private, Hybrid)',
                'description' => 'This article will explore the three primary types of cloud computing—public, private, and hybrid. It will explain how each model works, their benefits, and their use cases, helping businesses and individuals understand which option best suits their needs.',
                'content' => 'Cloud computing has become a pivotal technology for businesses and individuals alike, offering a flexible, scalable, and cost-effective way to manage IT resources. There are three primary types of cloud computing: public, private, and hybrid, each serving different needs and preferences. Public cloud computing refers to cloud services provided by third-party vendors, where resources like storage, computing power, and applications are made available over the internet to the public on a pay-as-you-go basis. This model is highly cost-efficient and scalable, but organizations may have limited control over the infrastructure. In contrast, private clouds are dedicated environments where resources are used exclusively by a single organization, offering greater control over security and customization. However, private clouds tend to be more expensive and less scalable compared to public clouds. A hybrid cloud is a blend of both public and private cloud models, providing businesses the flexibility to store sensitive data on private clouds while taking advantage of public cloud scalability for other operations. Understanding the advantages and challenges of each type is crucial for businesses to determine the best cloud deployment model based on their security, compliance, and operational needs.',
                'theme_id' => $cloudComputingTheme->id,
                'author_id' => $author1->id,
                'ispublic' => true,
                'image' => 'https://plus.unsplash.com/premium_photo-1683141114059-aaeaf635dc05?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'title' => 'The Importance of Data Security in Cloud Storage Solutions',
                'description' => 'This piece will highlight the critical role data security plays in cloud storage. It will discuss key security risks, best practices for safeguarding data in the cloud, and how encryption, compliance standards, and access controls can mitigate security threats.',
                'content' => 'Data security is one of the foremost concerns when businesses and individuals transition their data to cloud storage solutions. While cloud storage offers numerous benefits such as reduced infrastructure costs and increased scalability, it also introduces several security risks. Sensitive data stored in the cloud can be vulnerable to unauthorized access, cyberattacks, or even data loss due to natural disasters or human error. As a result, ensuring the security of cloud-based data is crucial for maintaining trust and compliance with data protection regulations like GDPR and HIPAA. Best practices for securing cloud storage include encrypting data both in transit and at rest, using multi-factor authentication, implementing strict access controls, and conducting regular security audits. Additionally, choosing a reputable cloud service provider with strong security certifications, such as ISO 27001 or SOC 2, can provide assurance that robust security measures are in place. With the rise of cloud-based applications and services, businesses must also stay informed about emerging security threats and continuously update their security protocols to protect against evolving risks.',
                'theme_id' => $cloudComputingTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.unsplash.com/photo-1561736778-92e52a7769ef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'title' => 'How Cloud Computing Enables Remote Work and Collaboration',
                'description' => 'This article will explain how cloud computing facilitates remote work by providing tools and services that enable communication, file sharing, real-time collaboration, and seamless access to company resources from anywhere in the world.',
                'content' => 'Cloud computing has fundamentally transformed how businesses operate, particularly in enabling remote work and collaboration. By providing access to cloud-based applications, storage, and services, cloud computing enables employees to work from any location with an internet connection, breaking down traditional office-based work barriers. Tools like cloud-based document sharing, project management software, and communication platforms (e.g., Slack, Microsoft Teams, and Google Workspace) allow teams to collaborate in real time, regardless of their geographic location. With cloud storage, employees can access and work on files simultaneously, ensuring that all team members are on the same page and up-to-date. Moreover, cloud solutions can support video conferencing and virtual meetings, which are critical for maintaining communication in a remote work environment. Cloud infrastructure also enables businesses to scale quickly, providing on-demand resources for remote workers as needed. In essence, cloud computing has made remote work not only feasible but also efficient, fostering greater flexibility, productivity, and collaboration within organizations worldwide.',
                'theme_id' => $cloudComputingTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.unsplash.com/photo-1600132806370-bf17e65e942f?q=80&w=1988&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'title' => 'Top Cloud Platforms Compared: AWS vs. Azure vs. Google Cloud',
                'description' => 'A comparison of the leading cloud platforms—Amazon Web Services (AWS), Microsoft Azure, and Google Cloud. This article will review their features, pricing, performance, and services to help users make informed decisions based on their needs and priorities.',
                'content' => 'When it comes to cloud platforms, three giants dominate the industry: Amazon Web Services (AWS), Microsoft Azure, and Google Cloud. Each of these platforms offers a wide range of services, from computing power and storage to machine learning and artificial intelligence, but they differ in various aspects. AWS, launched by Amazon in 2006, is the market leader and offers the most extensive set of features, global availability, and a wide array of tools for developers, enterprises, and startups. It is known for its reliability, scalability, and a vast ecosystem of third-party integrations. Microsoft Azure, on the other hand, has a strong integration with existing Microsoft products, making it an attractive choice for businesses already using Windows Server, Active Directory, and Office 365. Azure also excels in hybrid cloud solutions, enabling businesses to combine on-premise systems with the cloud. Google Cloud, while smaller than AWS and Azure, shines in areas such as data analytics, machine learning, and artificial intelligence, thanks to its expertise in search and cloud-based applications. Google Cloud is often favored for its strong data processing capabilities and cost-effectiveness for workloads that involve large-scale analytics. When comparing these platforms, factors like pricing, performance, and specific use cases need to be considered to determine which one best fits the needs of an organization.',
                'theme_id' => $cloudComputingTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://plus.unsplash.com/premium_photo-1681487942927-e1a2786e6036?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'title' => 'The Role of Cloud Computing in Driving Digital Transformation',
                'description' => 'This article will explore how cloud computing is a key enabler of digital transformation. It will discuss how organizations leverage cloud technologies to improve efficiency, innovate, scale operations, and adapt to changing market demands.',
                'content' => 'Cloud computing plays a central role in driving digital transformation across industries by enabling businesses to modernize their operations, enhance customer experiences, and unlock new opportunities for innovation. By moving to the cloud, organizations can access on-demand computing resources, enabling them to scale their operations quickly without the need for significant upfront capital investment in IT infrastructure. Cloud services also promote agility, allowing businesses to deploy new applications and features rapidly, which is crucial in today’s fast-paced digital economy. Furthermore, cloud technologies support the development of data-driven strategies by providing powerful analytics tools that help businesses harness insights from vast amounts of data. With cloud platforms offering services like machine learning, AI, and Internet of Things (IoT) integration, companies can also develop cutting-edge solutions that were previously out of reach. Additionally, the cloud provides flexibility in supporting remote work and global collaboration, which is essential for organizations operating in a connected world. As businesses increasingly look to remain competitive, cloud computing has become a key enabler of their digital transformation, providing the resources and capabilities to innovate and evolve in an ever-changing market.',
                'theme_id' => $cloudComputingTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.pexels.com/photos/1148820/pexels-photo-1148820.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            ],
            [
                'title' => 'Serverless Computing: The Next Big Step in Cloud Technology',
                'description' => 'Focusing on serverless computing, this article will explain this emerging cloud technology where developers can run code without managing servers. It will cover the benefits of serverless computing, such as cost efficiency and scalability, and its growing adoption in modern applications.',
                'content' => 'Serverless computing is an emerging paradigm in cloud technology that eliminates the need for developers to manage and provision servers. In a traditional cloud infrastructure, developers must configure and maintain servers to run applications, which can be time-consuming and costly. Serverless computing, however, abstracts away this responsibility, allowing developers to focus solely on writing and deploying code. With serverless computing, developers only pay for the actual execution time of their code, which can lead to significant cost savings as there is no need to keep servers running when not in use. This model also offers automatic scaling, where the cloud provider automatically adjusts resources based on demand, ensuring optimal performance during peak traffic and minimizing waste during low usage periods. Serverless platforms, such as AWS Lambda, Azure Functions, and Google Cloud Functions, provide a flexible and efficient way to build applications, particularly for event-driven workloads like data processing, microservices, and APIs. While serverless computing offers numerous advantages in terms of cost, scalability, and ease of use, it may not be suitable for all types of applications, particularly those requiring long-running processes or strict control over the underlying infrastructure. Nonetheless, serverless computing is rapidly gaining traction as the next big step in cloud technology, offering a future where developers can focus on innovation while the cloud platform handles the infrastructure.',
                'theme_id' => $cloudComputingTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.pexels.com/photos/577585/pexels-photo-577585.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            ],
            //* Game Development articles
            [
                'title' => 'Game Engines Explained: Choosing the Right Tool for Your Project',
                'description' => 'This article will provide an overview of the most popular game engines, such as Unity, Unreal Engine, and Godot, explaining their features, strengths, and weaknesses. It will guide readers on how to choose the best game engine based on their project’s requirements, such as platform compatibility, performance needs, and available resources.',
                'content' => 'Choosing the right game engine is a crucial step in game development, as it directly impacts the performance, scalability, and ease of development of the game. There are numerous game engines available, each with its own strengths and ideal use cases. Unity, for example, is one of the most popular and versatile game engines, known for its ease of use and wide platform support, including mobile, desktop, VR/AR, and consoles. Its rich ecosystem of assets and plugins makes it ideal for both beginners and seasoned developers. Unreal Engine, developed by Epic Games, is renowned for its high-end graphics and is often used in AAA game development, offering advanced rendering capabilities and a powerful visual scripting system (Blueprints). It\'s an excellent choice for developers aiming for photorealistic visuals and complex gameplay mechanics. Godot, an open-source game engine, is gaining traction for its lightweight design and flexibility, making it ideal for 2D games and indie developers looking for complete control over their projects without the complexity of commercial engines. When choosing a game engine, developers must consider factors such as the target platform, team expertise, and the complexity of the game itself. Budget constraints also play a significant role, with some engines offering free versions and others requiring a licensing fee based on revenue generation. Selecting the right game engine can save time, reduce costs, and allow developers to focus on the creative aspects of game design.',
                'theme_id' => $gameDevelopmentTheme->id,
                'author_id' => $author1->id,
                'ispublic' => true,
                'image' => 'https://plus.unsplash.com/premium_photo-1682141025267-9e0ade0c0826?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'title' => 'The Rise of Indie Game Development: Challenges and Success Stories',
                'description' => 'This article will explore the growth of indie game development, discussing the challenges small studios and solo developers face, such as limited budgets, marketing difficulties, and resource constraints. It will also highlight success stories of indie games that have achieved critical acclaim and commercial success, showing how passion, creativity, and innovation can lead to success in the competitive gaming industry.',
                'content' => 'Indie game development has seen a dramatic rise in recent years, fueled by advancements in game development tools, distribution platforms, and a growing demand for unique, innovative games. Indie developers, often working with limited budgets and small teams (or even alone), face significant challenges, including financial constraints, marketing difficulties, and the pressure of competing with large AAA studios. Despite these obstacles, many indie games have achieved massive success, both critically and commercially. Titles like "Undertale," "Hollow Knight," and "Stardew Valley" showcase the potential for indie games to resonate with players through captivating gameplay, creative storytelling, and unique artistic visions. However, indie developers must be resourceful, often relying on crowdfunding, early access models, and digital storefronts like Steam, itch.io, and the Epic Games Store to fund and distribute their games. The rise of social media, streaming platforms like Twitch, and game design communities also provide valuable exposure and direct engagement with players, creating a more accessible ecosystem for indie developers. In addition, platforms like Unity and Unreal Engine have made powerful game development tools available to all, democratizing access to professional-grade technology. While indie game development remains highly competitive and challenging, it also offers an exciting path for creativity and innovation, empowering developers to tell personal stories and experiment with unconventional gameplay mechanics in ways that larger studios often cannot.',
                'theme_id' => $gameDevelopmentTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.unsplash.com/photo-1532619675605-1ede6c2ed2b0?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'title' => 'How VR and AR Are Shaping the Future of Gaming',
                'description' => 'This article will examine how Virtual Reality (VR) and Augmented Reality (AR) are transforming the gaming experience. It will discuss how these technologies create immersive worlds and interactive environments, enhancing gameplay and storytelling, as well as how they influence game design, user experience, and player engagement.',
                'content' => 'Virtual Reality (VR) and Augmented Reality (AR) are revolutionizing the gaming world, offering players entirely new ways to experience interactive entertainment. VR immerses players in a completely digital environment, using a headset and motion controllers to simulate presence in a 3D space. This technology has made significant strides in gaming, with titles like "Half-Life: Alyx" and "Beat Saber" providing rich, immersive experiences that allow players to physically interact with the game world. The potential of VR extends beyond gaming, with applications in education, training, and entertainment, but in the gaming space, its ability to transport players into fantastical worlds has made it one of the most exciting developments in recent years. AR, on the other hand, overlays digital content onto the real world, offering a unique blend of the virtual and the physical. Games like "Pokémon Go" have demonstrated the power of AR by encouraging players to explore the real world while interacting with virtual elements. As both VR and AR technologies evolve, developers are finding new ways to blend storytelling, gameplay, and player interaction, creating more dynamic and immersive gaming experiences. The future of VR and AR in gaming will likely involve even more sophisticated hardware, improved motion tracking, and enhanced visual fidelity. Moreover, as the cost of VR headsets and AR-capable devices continues to decrease, these technologies will become more accessible, pushing the boundaries of what games can offer in terms of immersion and interactivity.',
                'theme_id' => $gameDevelopmentTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.pexels.com/photos/682933/pexels-photo-682933.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            ],
            [
                'title' => 'Storytelling in Games: Crafting Memorable Narratives',
                'description' => 'Focusing on the importance of narrative in video games, this article will delve into how compelling storytelling enhances player immersion and emotional connection. It will explore different narrative techniques, such as branching storylines, player choice, and character development, and how these contribute to creating memorable gaming experiences.',
                'content' => 'Storytelling in video games has evolved from simple narratives to complex, emotionally engaging stories that rival those found in movies and novels. Video games offer a unique opportunity for narrative immersion, as players not only experience a story but actively participate in shaping it through their actions. Crafting a memorable narrative in a game involves a delicate balance between storytelling, gameplay, and character development. Developers often use techniques such as branching storylines, dialogue trees, and player choices to create a narrative that feels personal and meaningful. Games like "The Witcher 3: Wild Hunt" and "The Last of Us" are prime examples of games where storytelling is central to the experience, weaving rich character arcs, moral dilemmas, and emotional depth into the gameplay. In these games, the player’s decisions have a direct impact on the story, creating a sense of agency and investment in the outcome. Furthermore, the narrative in games can be enhanced through environmental storytelling, where the world itself tells a story through its design, lore, and hidden details. The ability to intertwine story and gameplay in a seamless way allows developers to create compelling, memorable experiences that resonate with players long after they’ve finished the game. As games continue to push the boundaries of interactive media, the importance of strong storytelling in game development is more significant than ever.',
                'theme_id' => $gameDevelopmentTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://plus.unsplash.com/premium_photo-1682140932416-8b011dfa9b4b?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'title' => 'The Role of Artificial Intelligence in Game Design and Development',
                'description' => 'This article will explore the role of Artificial Intelligence (AI) in game development, from enhancing non-playable character (NPC) behaviors to creating dynamic, reactive game worlds. It will also touch on how AI is used in procedural content generation, adaptive difficulty, and improving the overall player experience, shaping the future of interactive entertainment.',
                'content' => 'Artificial Intelligence (AI) plays a crucial role in modern game design and development, influencing everything from non-playable character (NPC) behaviors to procedural content generation and game world dynamics. AI is used to make NPCs more intelligent and responsive to player actions, creating lifelike interactions that make games feel more immersive and dynamic. In open-world games like "Grand Theft Auto V" or "Red Dead Redemption 2," AI systems help populate the world with NPCs that react realistically to the player’s actions, whether they’re engaged in combat, exploration, or casual interactions. AI is also essential for adaptive difficulty, ensuring that a game remains challenging without becoming frustrating. Some games use AI to adjust the difficulty level dynamically, based on how well the player is performing, providing a personalized experience that keeps players engaged. Additionally, AI-driven procedural content generation is becoming more prevalent in game development, allowing for the creation of vast, unique worlds that would be too time-consuming for developers to design manually. Games like "No Man’s Sky" use procedural generation powered by AI to create endless, varied universes for players to explore. As AI technology continues to improve, the role of AI in game development is only expected to expand, making games more intelligent, responsive, and interactive, and pushing the boundaries of what is possible in gaming.',
                'theme_id' => $gameDevelopmentTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.unsplash.com/photo-1556438064-2d7646166914?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'title' => 'Monetization Models in Gaming: From Free-to-Play to NFTs',
                'description' => 'This article will examine various monetization models in the gaming industry, including free-to-play, microtransactions, subscription services, and the emerging trend of Non-Fungible Tokens (NFTs). It will discuss the pros and cons of each model, how they impact player engagement, and their ethical considerations, while also predicting the future direction of game monetization strategies.',
                'content' => 'Monetization in gaming has evolved significantly over the years, with developers exploring various models to generate revenue while providing players with engaging experiences. The free-to-play (F2P) model has become one of the most popular, allowing players to access a game for free while offering in-game purchases such as cosmetics, currency, or other virtual goods. This model has been highly successful in mobile gaming, with games like "Fortnite" and "League of Legends" generating billions in revenue through microtransactions. However, the F2P model has faced criticism for promoting "pay-to-win" mechanics, where players who spend money have an advantage over those who don’t. Subscription-based models, like Xbox Game Pass and PlayStation Now, offer players access to a library of games for a monthly fee, allowing them to try multiple titles without committing to individual purchases. Another emerging trend in gaming monetization is the use of Non-Fungible Tokens (NFTs) and blockchain technology. NFTs are unique digital assets that can be bought, sold, or traded, allowing players to truly own in-game items, characters, or land in a way that was not possible before. While NFTs have the potential to revolutionize the gaming industry, they have also sparked debates about their environmental impact, their role in speculative markets, and their potential to alienate players who feel excluded from participating. As the gaming industry continues to experiment with new monetization strategies, the future of in-game purchases, subscriptions, and NFTs will be shaped by player preferences, regulatory concerns, and technological advancements. Balancing profitability with player satisfaction will remain a key challenge for developers in this evolving landscape.',
                'theme_id' => $gameDevelopmentTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.unsplash.com/photo-1534423861386-85a16f5d13fd?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            //* Data Science Articles

            [
                'title' => 'An Introduction to Data Science: Tools and Techniques for Beginners',
                'description' => 'This article will provide an overview of data science, explaining its importance and key components, including data collection, data cleaning, analysis, and visualization. It will introduce beginners to popular tools and programming languages used in the field, such as Python, R, and SQL, as well as common techniques like regression analysis, classification, and clustering. The goal is to provide a solid foundation for those new to data science and inspire further learning.',
                'content' => 'Data science is a multidisciplinary field that combines statistical analysis, programming, and domain expertise to extract valuable insights from data. ...',
                'theme_id' => $dataScienceTheme->id,
                'author_id' => $author1->id,
                'ispublic' => true,
                'image' => 'https://images.unsplash.com/photo-1523961131990-5ea7c61b2107?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],
            [
                'title' => 'Predictive Analytics in Business: How Data Science Drives Decision-Making',
                'description' => 'This article will explore how predictive analytics, a branch of data science, is used in business to make data-driven decisions. ...',
                'content' => 'Predictive analytics is a branch of data science that uses historical data, statistical algorithms, and machine learning techniques to forecast future events and trends. ...',
                'theme_id' => $dataScienceTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],
            [
                'title' => 'Big Data vs. Small Data: Choosing the Right Approach for Your Needs',
                'description' => 'This article will compare big data and small data, helping readers understand the differences between the two and when to use each approach. ...',
                'content' => 'Big data and small data are two distinct approaches to data management and analysis, each with its own set of challenges, tools, and ideal use cases. ...',
                'theme_id' => $dataScienceTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://plus.unsplash.com/premium_photo-1661878265739-da90bc1af051?q=80&w=1986&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],
            [
                'title' => 'The Role of Data Visualization in Communicating Insights',
                'description' => 'This article will emphasize the importance of data visualization in data science, focusing on how it helps to communicate complex data insights clearly and effectively. ...',
                'content' => 'Data visualization plays a critical role in transforming raw data into meaningful insights that can be easily understood by both technical and non-technical audiences. ...',
                'theme_id' => $dataScienceTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],
            [
                'title' => 'Machine Learning vs. Deep Learning: What’s the Difference?',
                'description' => 'This article will clarify the distinction between machine learning (ML) and deep learning (DL), two key subfields of artificial intelligence. ...',
                'content' => 'Machine learning (ML) and deep learning (DL) are two subfields of artificial intelligence (AI) that are often used interchangeably, but they are distinct in terms of their complexity and capabilities. ...',
                'theme_id' => $dataScienceTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.unsplash.com/photo-1526628953301-3e589a6a8b74?q=80&w=2006&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],
            [
                'title' => 'Real-World Applications of Data Science in Healthcare, Retail, and Finance',
                'description' => 'This article will explore the diverse applications of data science across various industries, highlighting how it transforms sectors like healthcare, retail, and finance. ...',
                'content' => 'Data science is revolutionizing industries by enabling organizations to make data-driven decisions that improve efficiency, enhance customer experiences, and drive innovation. ...',
                'theme_id' => $dataScienceTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.unsplash.com/photo-1599658880436-c61792e70672?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],


            //* Internet of Things Articles 

            [
                'title' => 'Internet of Things (IoT): Revolutionizing Connectivity',
                'description' => 'This article provides an introduction to the Internet of Things (IoT), explaining its core concept and how it connects everyday objects to the internet, allowing them to send and receive data...',
                'content' => 'The Internet of Things (IoT) is a transformative technology that connects everyday objects to the internet...',
                'theme_id' => $iotTheme->id,
                'author_id' => $author1->id,
                'ispublic' => true,
                'image' => 'https://plus.unsplash.com/premium_photo-1688678097473-2ce11d23e30c?q=80&w=1940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],
            [
                'title' => 'Smart Cities: How IoT Is Transforming Urban Living',
                'description' => 'This article explores the role of IoT in transforming cities into "smart cities" by integrating technology into urban infrastructure...',
                'content' => 'The Internet of Things (IoT) is revolutionizing urban living by creating smarter cities with enhanced efficiency...',
                'theme_id' => $iotTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.pexels.com/photos/163073/raspberry-pi-computer-linux-163073.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
            ],
            [
                'title' => 'IoT in Healthcare: From Wearables to Remote Patient Monitoring',
                'description' => 'This article examines the growing impact of IoT in healthcare, particularly through the use of wearable devices...',
                'content' => 'The healthcare industry is undergoing a significant transformation thanks to IoT...',
                'theme_id' => $iotTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.pexels.com/photos/159304/network-cable-ethernet-computer-159304.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
            ],
            [
                'title' => 'Challenges and Risks in IoT Security: Protecting a Connected World',
                'description' => 'This article delves into the security challenges and risks associated with IoT, where millions of devices are interconnected...',
                'content' => 'While the Internet of Things (IoT) offers numerous benefits, it also introduces significant security challenges...',
                'theme_id' => $iotTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.pexels.com/photos/57007/pexels-photo-57007.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
            ],
            [
                'title' => 'The Future of IoT in Agriculture: Precision Farming and Beyond',
                'description' => 'This article looks at how IoT is revolutionizing agriculture through precision farming, where connected sensors...',
                'content' => 'IoT is transforming agriculture by enabling precision farming, a revolutionary approach...',
                'theme_id' => $iotTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.unsplash.com/photo-1555664424-778a1e5e1b48?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],
            [
                'title' => 'Integrating IoT with Artificial Intelligence: Smarter Devices for a Smarter World',
                'description' => 'This article discusses how integrating IoT with artificial intelligence (AI) can create smarter, more autonomous devices...',
                'content' => 'The integration of IoT with Artificial Intelligence (AI) is creating a new wave of smarter devices...',
                'theme_id' => $iotTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://plus.unsplash.com/premium_photo-1661411311489-46be8dfc82bd?q=80&w=2130&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],
            [
                'title' => 'A Beginner’s Guide to Building Your Own IoT Project',
                'description' => 'This article serves as a beginner-friendly guide for those looking to start their own IoT projects...',
                'content' => 'Building your own Internet of Things (IoT) project can be an exciting and educational experience...',
                'theme_id' => $iotTheme->id,
                'author_id' => $author1->id,
                'ispublic' => false,
                'image' => 'https://images.unsplash.com/photo-1558346490-a72e53ae2d4f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],


        ];

        //* Insert the data into the articles table
        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
