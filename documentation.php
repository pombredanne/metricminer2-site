<? include("header.php"); ?>



<div class="row">
    <div class="col-lg-12">
        <h1>Documentation</h1>

        <ul>
            <li><a href="our-first-study">Our first study</a></li>
        </ul>

        <h2 id="our-first-study">Our first study</h2>

        <p>
            You simply have to start a Java Project in Eclipse. MetricMiner is on Maven, so
            you can download all its dependencies: 

            <script src="https://gist.github.com/mauricioaniche/9acb8a7688492a951d42.js"></script>
        </p>

        <p>
            MetricMiner needs a <i>Study</i>. The interface is quite simple: a single <i>execute()</i>
            method:

            <script src="https://gist.github.com/mauricioaniche/82b9118f874b7bb8dc72.js"></script>
        </p>
        
        <p>
            All the magic goes inside this method. In there, you will have to configure
            your study, projects to analyze, metrics to be executed, and output files.
            Take a look in the example. That's what we have to configure:

            <script src="https://gist.github.com/mauricioaniche/f3f2d96a69a4c283f3e5.js"></script>
        </p>

        <p>
            Let's start with something simple: we will print the name of the developers
            for each commit. For now, you should not care about all possible configurations.
            We will analyze all commits in the project at "/Users/mauricioaniche/workspace/metricminer2",
            outputing <i>DevelopersVisitor</i> to "/Users/mauricioaniche/Desktop/devs.csv".

            <ul>
            <li>in(): We use to configure the project (or projects) that will be analyzed.</li>
            <li>through(): The list of commits to analyze. We want all of them.</li>
            <li>process(): Visitors that will pass in each commit.</li>
            <li>mine(): The magic starts!</li>
            </ul>

            <script src="https://gist.github.com/mauricioaniche/37a3b0b9049a81523616.js"></script>
        </p>

        <p>
            In practice, MetricMiner will open the Git repository and will extract all information
            that is inside. Then, the framework will pass each commit to all processors. Let's write
            our first <i>DevelopersProcessor</i>. It is fairly simple. All we will do is to print
            the commit hash and the name of the developer. MetricMiner gives us nice objects to
            play with all the data:

            <script src="https://gist.github.com/mauricioaniche/04387fa9830c542e9a60.js"></script>
        </p>

        <p>
        That's it, we are ready to go! If we execute it, we will have the CSV printed
        into "/Users/mauricioaniche/Desktop/devs.csv". <a href="download/devs.csv" target="_blank">Take a look</a>.
        </p>

        <p>
        <strong>I bet you never found a framework simple as this one!</strong>
        </p>

        <h2>Configuring the project</h2>


        <p>
        	- configurando, threads
        	- projeto ou lista de projetos
        	- primeiro visitor
        	- persistencemechanism
        	- classe commit
        	- modifications
        	- log
        	- quando nao usar varias threads
        	- check out a version
        	- parseando java
        	--- jdt
        	--- antlr
        	- data joy

        </p>

    </div>
</div>
</div>



<? include("footer.php"); ?>