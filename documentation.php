<? include("header.php"); ?>



<div class="row">
    <div class="col-lg-12">
        <h1>Documentation</h1>

        <? include("menu.php"); ?>

        <h2 id="getting-started">Getting Started</h2>

        <p>
            You simply have to start a Java Project in Eclipse. MetricMiner is on Maven, so
            you can download all its dependencies by only adding this to your pom.xml. Or, if
            you want, you can download a <a href="download/metricminer2-skeleton.zip">skeleton project</a>: 

            <script src="https://gist.github.com/mauricioaniche/82b9118f874b7bb8dc72.js"></script>
        </p>

        <p>
            MetricMiner needs a <i>Study</i>. The interface is quite simple: a single <i>execute()</i>
            method:

            
            <script src="https://gist.github.com/mauricioaniche/9acb8a7688492a951d42.js"></script>
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
            our first <i>DevelopersProcessor</i>. It is fairly simple. All we will do is to implement
            <i>CommitVisitor</i>. And, inside of <i>process()</i>, we print
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

        <h2 id="configuring">Configuring the project</h2>

        <p>
        The first thing you configure in MetricMiner is the project you want to
        analyze. MetricMiner currently only suports Git repositories. The <i>GitRepository</i>
        class contains two factory methods to that: 

        <ul>
            <li><i>singleProject(path)</i>: When you want to analyze a single repository.</li>
            <li><i>allProjectsIn(path)</i>: When you want to analyze many repositories. In this case,
            you should pass a path to which all projects are sub-directories of it. Each directory
            will be considered as a project to MetricMiner.</li>
        </ul>
        </p>

        <h2 id="logging">Logging</h2>

        <p>
        MetricMiner uses log4j to print useful information about its execution. 
        We recommend tou to have a log4.xml:

        <script src="https://gist.github.com/mauricioaniche/37a2c216d689e8ff9a4e.js"></script>
        </p>

        <h2 id="commit-range">Selecting the Commit Range</h2>

        <p>
        MetricMiner allows you to select the range of commits to be processed. 
        The class <i>Commits</i> contains different methods to that:

        <ul>
            <li><i>all()</i>: All commits. From the first to the last.</li>
            <li><i>onlyInHead()</i>: It only analyzes the most recent commit.</li>
            <li><i>single(hash)</i>: It only analyzes a single commit with the provided hash.</li>
            <li><i>monthly(months)</i>: It selects one commit per month, from the beginning to the end of the repo.</li>
            <li><i>range(commits...)</i>: The list of commits to be processed.</li>
        </ul>
        </p>

        <h2 id="modifications">Getting Modifications</h2>

        <p>
        You can get the list of modified files, as well as their diffs and current
        source code. To that, all you have to do is to get the list of <i>Modification<i>s
        that exists inside <i>Commit</i>. A <i>Commit</i> contains a hash, a committer (name
        and email), a message, the date, its parent hash, and the list of modification.

        <script src="https://gist.github.com/mauricioaniche/3472f5c2f5961f734664.js"></script>

        </p>

        <p>
        A <i>Modification</i> contains a type (ADD, COPY, RENAME, DELETE, MODIFY), a
        diff (with the exact format Git delivers) and the current source code. Remember
        that it is up to you to handle deleted or renamed files in your study.
        </p>

        <h2 id="state">Managing State in the Visitor</h2>

        <p>

        If you need to, you can store state in your visitors. As an example, if you do
        not want to process a huge CSV, you can pre-process something before. As an example,
        if you want to count the total number of modified files per developer, you can
        either output all developers and the quantity of modifications, and then sum it later
        using your favorite database, or do the math in the visitor.

        <script src="https://gist.github.com/mauricioaniche/a86ef140ffc7f9f73aa3.js"></script>  

        If you decide to do it, it will be your responsibility to save the results afterwards.
        </p>

        <h2 id="parse">Parsing Code</h2>

        <p>
        You have entire source code of the repository. You may want to analyze it. MetricMiner
        comes with JDT and ANTLR bundled. JDT is the Eclipse internal parser, so you will not
        regret to use it.
        </p>

        <p>
        Let's say we decide to count the quantity of methods in each modified file. 
        All we have to do is to create a <i>CommitVisitor</i>, the way we are used to. This
        visitor will use our <i>JDTRunner</i> to invoke a JDT visitor (yes, JDT uses visitors
        as well).

        <script src="https://gist.github.com/mauricioaniche/4e1ad0787772f198ec8b.js"></script>

        Notice that we executed the JDT visitor, and then wrote the result.
        </p>

        <p>
        The visitor is quite simple. It has methods for all different nodes in the file. All you
        have to do is to visit the right node. As an example, we will visit <i>MethodDeclaration</i>
        and count the number of times it is invoked (one per each method in this file).

        <script src="https://gist.github.com/mauricioaniche/a468bd07b6f20fab7457.js"></script>

        If you want to see all methods available, check the documentation for <a href="http://help.eclipse.org/juno/index.jsp?topic=%2Forg.eclipse.jdt.doc.isv%2Freference%2Fapi%2Forg%2Feclipse%2Fjdt%2Fcore%2Fdom%2FASTVisitor.html">ASTVisitor</a>.
        </p>

        <h2 id="current-revision">Getting the Current Revision</h2>

        <p>
        If you need more than just the metadata from the commit, you may also check out
        to the revision to access all files. This may be useful when you need to parse
        all files inside that revision.

        </p>

        <p>
        To that, we will <i>checkout()</i> the revision, and get all <i>files()</i>. It
        returns the list of all files in the project at that moment. Then, it is up to
        you to do whatever you want. In here, we will use our <i>NumberOfMethodsVisitor</i>
        to count the number of files in all Java files. 

        <script src="https://gist.github.com/mauricioaniche/09ea37ba89bc44deee91.js"></script>

        Please, remember to <i>reset()</i> as soon as you finish playing with the files.
        </p>

        <h2 id="threads">Dealing with Threads</h2>

        <p>
        How good is your machine? MetricMiner can execute the visitor over many threads.
        This is just another configuration you set in <i>RepositoryMining</i>. The
        <i>withThreads()</i> lets you configure the number of threads the framework will
        use to process everything.

        <script src="https://gist.github.com/mauricioaniche/2298e38be0d98d9d27db.js"></script>
        </p>

        <p>
        We suggest you to use threads unless your project <i>checkout</i> revisions. The
        checkout operation in Git changes the disk, so you can't actually parallelize the work.
        </p>

        <h2 id="datajoy">Using DataJoy</h2>

        <p>
        You have a bunch of CSV files. Do whatever you want with them. We usually upload
        it to a MySQL file or play it with R. If you haven't tried DataJoy yet, you should.
        It allows you to upload a CSV file and manipulate.

        <script src="https://gist.github.com/mauricioaniche/f1beded4fa73788ec620.js"></script>

        </p>

        <p>
        You can play with the <a href="https://www.getdatajoy.com/project/55e36c0e3b765b3001b99476">project here</a>.
        </p>

        <h2 id="advanced">Advanced Configurations</h2>

        <h3>Creating your own CommitRange</h3>

        <p>(not written yet)</p>

        <h3>Creating your own PersistenceMechanism</h3>

        <p>(not written yet)</p>

    </div>
</div>
</div>



<? include("footer.php"); ?>